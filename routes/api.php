<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\BondController;
use App\Http\Controllers\Api\BondOrderController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/



Route::get('bond/{id}/payouts',[BondController::class,'bondPayouts']);
Route::post('bond/{id}/order',[BondOrderController::class,'bondOrder']);
Route::post('bond/order/{order_id}',[BondOrderController::class,'bondOrderPayouts']);


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
