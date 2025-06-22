<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Booking;
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

    public function store(Request $request)
    {

        // Create the booking (replace these with real values)
        Booking::create([
            'user_id' => auth()->id(),
            'car_id' => $request->car_id,
            'car_plate'=>'WXA'.rand(1000,9999),
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'price' => $request->price,
            'status' => 'booked',
            'pic_name'=>'Ally Lee',
            'contact_no'=>'60128945678',
            'verification_code'=>rand(100000,999999)
        ]);

        // Redirect with success message
        return redirect()->route('dashboard')->with('success', 'Booking successfully created!');
    }
}



