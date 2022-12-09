<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BondOrder extends Model
{
    use HasFactory,SoftDeletes;

    protected $table = 'bond_orders';
    protected $guarded = [];
    protected $load='bond';

    public function bond(){
        return $this->belongsTo(Bond::class);
    }
}
