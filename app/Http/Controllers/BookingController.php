<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BookingController extends Controller
{
    public function getCarDetail($id)
    {
        $car = Car::find($id);
        return view('booking', compact('car'));
    }

    public function getBookingDetail(Request $request)
    {
        $carId = $request->id;
        $start = $request->start_date;
        $end = $request->end_date;
        $price = $request->price;

        $car = Car::findOrFail($carId);

        return view('payment', compact('car', 'start', 'end', 'price'));
    }
}



