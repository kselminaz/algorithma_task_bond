<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BondResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id'=>$this->id,
            'issue_date'=>$this->issue_date,
            'last_circulation_date'=>$this->last_circulation_date,
            'nominal_price'=>$this->nominal_price,
            'coupon_payout_frequency'=>$this->coupon_payout_frequency,
            'interest_calculation_period'=>$this->interest_calculation_period,
            'coupon_interest'=>$this->coupon_interest,
        ];
    }
}
