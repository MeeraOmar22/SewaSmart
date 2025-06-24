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
    'passenger_capacity',
    'price',
    'availability',
    'car_type',
    'pickup_location',
    'available_from',
    'available_until',
    'car_plate', // ← ✅ Make sure this line exists
    ];

        /** Half-day = half of full-day price */
    public function getHalfDayPriceAttribute()
    {
        return round($this->price / 2, 2);
    }

    /** Hourly rate = full-day / 24 */
    public function getHourlyRateAttribute()
    {
        return round($this->price / 24, 2);
    }
}
