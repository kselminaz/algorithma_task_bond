<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\BondPayoutController;
use App\Http\Controllers\Controller;
use App\Http\Requests\BondOrderRequest;
use App\Http\Resources\BondOrderResource;
use App\Models\Bond;
use App\Models\BondOrder;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BondOrderController extends Controller
{
    public function bondOrder($id,Request $request){

        $bond=Bond::find($id);
        if(!$bond)
            return BaseController::jsonResponse(0,[],"The bond is not found",404);

        $validator = Validator::make($request->all(), [

            'order_date'=>['required','date'],
            'order_count'=>['required','numeric','min:1'],

        ]);
        if ($validator->fails()) {

            return BaseController::jsonResponse(false,[],$validator->errors(),400);
        }
        if(Carbon::parse($request->order_date)<Carbon::parse($bond->issue_date)){
            return BaseController::jsonResponse(0,[],"The order date is less than the bond issue date",400);
        }

        if(Carbon::parse($request->order_date)>Carbon::parse($bond->last_circulation_date)){
            return BaseController::jsonResponse(0,[],"The order date is greater than the bond last circulation date",400);
        }

        $bondOrder=new BondOrder();
        $bondOrder->bond_id=$id;
        $bondOrder->order_date=Carbon::parse($request->order_date)->format('Y-m-d');
        $bondOrder->bond_order_count=$request->order_count;
        $bondOrder->save();

        $bondOrder=new BondOrderResource($bondOrder);
        return BaseController::jsonResponse(1,$bondOrder,"Bond Order Model",200);

    }

    public function bondOrderPayouts($order_id){

        $bondOrder=BondOrder::find($order_id);
        if(!$bondOrder)
            return BaseController::jsonResponse(0,[],"The bond order is not found",404);

        $bond_id=$bondOrder->bond_id;
        $bond=Bond::find($bond_id);

        //Istiqrazin faiz odenilme tarixleri alinir
        $dates=BondPayoutController::bondPayoutDates($bond_id);

        //Faizlerin hesablanma periodu
        $periodWithDay=BondPayoutController::periodWithDay($bond_id);

        /*Istiqrazin faiz odenilme tarixleri bir bir yoxlanilir,istiqrazin sifarish
         tarixinden sonraki tarixler uchun odenilecek mebleg hesablanir*/
        $response_array=[];
        $passed_days=1;
        foreach ($dates as $key=>$date){
            if(Carbon::parse($date['date'])>Carbon::parse($bondOrder->order_date)){
                //Kechen gunlerin hesablanmasi uchun
                //Eger ilk odenish gunudurse
               if(count($response_array)==0)
               $passed_days=Carbon::parse($dates[$key]['date'])->diffInDays(Carbon::parse($bondOrder->order_date));
               //novbeti odenish gunleri uchun
                else
                $passed_days=Carbon::parse($dates[$key-1]['date'])->diffInDays(Carbon::parse($date['date']));
                $amount = ($bond->nominal_price / 100 * $bond->coupon_interest ) / $periodWithDay
                * $passed_days * $bondOrder->bond_order_count;
                array_push($response_array,["date"=>$date['date'],"amount"=>round($amount,4)]);
            }

        }
        return BaseController::jsonResponse(1,$response_array,"Order payout dates and amounts",200);



    }
}
