<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;
    protected $casts = [
      'start_date'      => 'datetime',
      'end_date'        => 'datetime',
      'extras'          => 'array',
    ];

    protected $fillable = [
      'user_id','car_id','car_plate',
      'full_name','email','address',
      'license_no','license_expiry',
      'start_date','end_date',
      'additional_drivers','rental_option','hours',
      'extras','insurance','pickup_location',
      'price','verification_code','status',
      'feedback','rating','penalty', 'pic_name','contact_no' // ← ✅ this must be here
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function car()
    {
        return $this->belongsTo(Car::class);
    }

    
}
