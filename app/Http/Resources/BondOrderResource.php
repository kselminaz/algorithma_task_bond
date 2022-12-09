<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BondOrderResource extends JsonResource
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
            'bond'=>new BondResource($this->bond),
            'order_date'=>$this->order_date,
            'bond_order_count'=>$this->bond_order_count
        ];
    }
}
