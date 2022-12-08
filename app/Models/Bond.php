<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bond extends Model
{
    use HasFactory,SoftDeletes;

    protected $table = 'bonds';
    protected $guarded = [];

    public function orders(){
        return $this->hasMany(BondOrder::class);
    }
}
