<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Booking;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BookingController extends Controller
{
    public function getCarDetail(Request $request, $id)
    {
        $car = Car::findOrFail($id);
        $start = $request->start_date;
        $end = $request->end_date;

        if ($start && $end) {
            $days = \Carbon\Carbon::parse($end)->diffInDays(\Carbon\Carbon::parse($start)) + 1;
            $calculatedPrice = $car->price * $days;
        } else {
            $calculatedPrice = 0;
        }

        return view('booking', compact('car', 'start', 'end', 'calculatedPrice'));
    }

    public function getBookingDetail(Request $request)
    {
        session()->put('booking_data', $request->all());

        $car = Car::findOrFail($request->car_id);
        $start = $request->start_date;
        $end   = $request->end_date;
        $price = $request->price;

        return view('payment', compact('car', 'start', 'end', 'price'));
    }

    public function store(Request $request)
    {
        $data = session('booking_data');

        if (!$data) {
            return redirect()->route('cars.listings')->withErrors('Booking session expired.');
        }

        $validated = validator($data, [
            'car_id'             => 'required|exists:cars,id',
            'full_name'          => 'required|string|max:255',
            'email'              => 'required|email',
            'contact_no'         => 'required|string|max:20',
            'address'            => 'nullable|string',
            'license_no'         => 'required|string',
            'license_expiry'     => 'required|date',
            'start_date'         => 'required|date',
            'end_date'           => 'required|date',
            'pickup_location'    => 'required|string',
            'additional_drivers' => 'nullable|integer|min:0',
            'rental_option'      => 'required|in:full_day,half_day,hourly',
            'hours'              => 'nullable|integer|min:1|max:23',
            'extras'             => 'nullable|array',
            'insurance'          => 'required|in:full,none',
            'price'              => 'required|numeric',
        ])->validate();

        $validated['user_id']           = auth()->id();
        $validated['verification_code'] = rand(100000, 999999);
        $validated['status']            = 'booked';
        $validated['extras']            = isset($validated['extras']) ? json_encode($validated['extras']) : null;

        $car = Car::findOrFail($validated['car_id']);
        $validated['car_plate'] = $car->car_plate;
        $validated['pic_name'] = 'Sarah Hook';
        $validated['contact_no'] = $validated['contact_no'] ?? auth()->user()->phone ?? 'N/A';




        Booking::create($validated);

        session()->forget('booking_data');

        return redirect()
            ->route('dashboard')
            ->with('success', 'Booking successfully created! Your code: ' . $validated['verification_code']);
    }

    public function confirmPayment(Request $request)
    {
        $data = $request->validate([
            'car_id'             => 'required|exists:cars,id',
            'full_name'          => 'required|string|max:255',
            'email'              => 'required|email',
            'contact_no'         => 'required|string|max:20',
            'address'            => 'nullable|string',
            'license_no'         => 'required|string',
            'license_expiry'     => 'required|date',
            'start_date'         => 'required|date',
            'end_date'           => 'required|date',
            'pickup_location'    => 'required|string',
            'additional_drivers' => 'nullable|integer|min:0',
            'rental_option'      => 'required|in:full_day,half_day,hourly',
            'hours'              => 'nullable|integer|min:1|max:23',
            'extras'             => 'nullable|array',
            'insurance'          => 'required|in:full,none',
            'price'              => 'required|numeric',
        ]);

        $data['user_id']           = auth()->id();
        $data['verification_code'] = rand(100000, 999999);
        $data['status']            = 'booked';
        $data['extras']            = isset($data['extras']) ? json_encode($data['extras']) : null;

        $car = Car::findOrFail($data['car_id']);
        $data['car_plate'] = $car->car_plate;
       $data['pic_name'] = 'Sarah Hook';
        $$data['contact_no'] = $data['contact_no'] ?? auth()->user()->phone ?? 'N/A';




        Booking::create($data);

        return redirect()
            ->route('dashboard')
            ->with('success', 'Booking successfully created! Your code: ' . $data['verification_code']);
    }

    public function showPayment(Request $request)
    {
        $carId = $request->id;
        $start = $request->start_date;
        $end   = $request->end_date;
        $price = $request->price;

        $car = Car::findOrFail($carId);

        return view('payment', compact('car', 'start', 'end', 'price'));
    }
}
