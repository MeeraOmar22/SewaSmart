<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Car;

class CarController extends Controller
{
    public function index(Request $request)
    {
        $query = Car::query();

        if ($request->filled('car_brand')) {
            $query->where('brand', $request->car_brand);
        }

        if ($request->filled('transmission_type')) {
            $query->where('transmission_type', $request->transmission_type);
        }

        if ($request->filled('price_min')) {
            $query->where('price', '>=', $request->price_min);
        }

        if ($request->filled('price_max')) {
            $query->where('price', '<=', $request->price_max);
        }

        $cars = $query->get();

        // 🟢 Get unique filter values
        $brands = Car::select('brand')->distinct()->pluck('brand');
        $transmissions = Car::select('transmission_type')->distinct()->pluck('transmission_type');

        return view('listing', compact('cars', 'brands', 'transmissions'));
    }

}
