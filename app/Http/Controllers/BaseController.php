<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;

class BaseController extends Controller
{
    public static function jsonResponse($status, $data, $message, $statusCode)
    {
        return response()->json([
            'status' => $status,
            'data' => $data,
            'message' => $message,
        ], $statusCode);
    }
    public static function availablePayoutDate(Carbon $date){
        if($date->dayOfWeekIso==6) $date=$date->addDay(2);
        if($date->dayOfWeekIso==7) $date=$date->addDay(1);
        return $date->format('Y-m-d');
    }
}
