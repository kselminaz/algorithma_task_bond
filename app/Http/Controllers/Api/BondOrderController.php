<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Http\Requests\BondOrderRequest;
use App\Http\Resources\BondOrderResource;
use App\Models\Bond;
use App\Models\BondOrder;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BondOrderController extends Controller
{
    public function bondOrder($id,BondOrderRequest $request){

        $bond=Bond::find($id);
        if(!$bond)
            return BaseController::jsonResponse(0,[],"The bond is not found",404);

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
}
