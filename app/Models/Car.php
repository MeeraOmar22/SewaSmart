<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
        protected $fillable = [
        'brand',
        'model',
        'transmission_type',
        'fuel_type',
        'price',
        'availability',
    ];
}
