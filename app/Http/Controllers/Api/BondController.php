<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\BondPayoutController;
use App\Http\Controllers\Controller;
use App\Models\Bond;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BondController extends Controller
{
    public function bondPayouts($id){

        $bond=Bond::find($id);
        if(!$bond)
            return BaseController::jsonResponse(0,[],"The bond is not found",404);

       /* //Faizlərin Hesablanma Periodunun teyini
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
        }*/

       //Faiz odenilme tarixlerinin teyini
        $dates=BondPayoutController::bondPayoutDates($id);
        return BaseController::jsonResponse(1,$dates,"Interest Payout Dates",200);

    }

}
