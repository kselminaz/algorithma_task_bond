<?php

namespace App\Http\Controllers;

use App\Models\Bond;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BondPayoutController extends Controller
{
    public static function periodWithDay($id){
        $bond=Bond::find($id);
        $interestCalculationPeriod=$bond->interest_calculation_period;
        $couponPayoutFrequency=$bond->coupon_payout_frequency;

        //Faizlərin Hesablanma Periodunun teyini
        switch ($interestCalculationPeriod) {
            case 360:
                $periodWithDay = 12 / $couponPayoutFrequency * 30;
                break;
            case 364:
                $periodWithDay = 364 / $couponPayoutFrequency;
                break;
            case 365:
                $periodWithDay = 12 / $couponPayoutFrequency * 30;
                break;
        }
        return $periodWithDay;

    }
    public static function bondPayoutDates($id){
        $bond=Bond::find($id);
        $dates=[];
        $periodWithDay=self::periodWithDay($id);
        $interestPayoutDate=Carbon::parse($bond->issue_date)->addDay($periodWithDay);
        while($interestPayoutDate<Carbon::parse($bond->last_circulation_date)){
            array_push($dates,["date"=>BaseController::availablePayoutDate($interestPayoutDate)]);
            $interestPayoutDate=$interestPayoutDate->addDay($periodWithDay);
        }
        return $dates;

    }
}
