<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Models\Bond;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BondController extends Controller
{
    public function bondPayouts($id){

        $bond=Bond::find($id);
        if(!$bond)

        $interestCalculationPeriod=$bond->interest_calculation_period;
        $couponPayoutFrequency=$bond->coupon_payout_frequency;

        //Faizlərin Hesablanma Periodunun teyini
        switch ($interestCalculationPeriod) {
            case 360:
                $periodWithDay = 360 / $couponPayoutFrequency;
            break;
            case 364:
                $periodWithDay = 364 / $couponPayoutFrequency;
            break;
            case 365:
                $periodWithDay = 365 / $couponPayoutFrequency;
            break;
        }

       //Faiz odenilme tarixlerinin teyini
        $dates=[];
        $interestPayoutDate=Carbon::parse($bond->issue_date)->addDay($periodWithDay);
        while($interestPayoutDate<Carbon::parse($bond->last_circulation_date)){
            array_push($dates,["date"=>BaseController::availablePayoutDate($interestPayoutDate)]);
            $interestPayoutDate=$interestPayoutDate->addDay($periodWithDay);
        }
        return BaseController::jsonResponse(1,$dates,"Interest Payout Dates",200);

    }
}
