<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Car;
use App\Models\Booking;
use Carbon\Carbon;

class CarController extends Controller
{
    public function index(Request $request)
    {
        $query = Car::select('*');


        // Filter: Brand
        if ($request->filled('car_brand')) {
            $query->where('brand', $request->car_brand);
        }

        // Filter: Model
        if ($request->filled('model')) {
            $query->where('model', $request->model);
        }

        // Filter: Car Type
        if ($request->filled('car_type')) {
            $query->where('car_type', $request->car_type);
        }

        // Filter: Transmission
        if ($request->filled('transmission_type')) {
            $query->where('transmission_type', $request->transmission_type);
        }

        // Filter: Fuel Type
        if ($request->filled('fuel_type')) {
            $query->where('fuel_type', $request->fuel_type);
        }

        // Filter: Passenger Capacity
        if ($request->filled('passenger_capacity')) {
            $query->where('passenger_capacity', $request->passenger_capacity);
        }

        // Filter: Pickup Location
        if ($request->filled('pickup_location')) {
            $query->where('pickup_location', 'LIKE', '%' . $request->pickup_location . '%');
        }

        // Filter: Price Range (from dropdown like "100-199")
        if ($request->filled('price_range')) {
            [$min, $max] = explode('-', $request->price_range);
            $query->whereBetween('price', [(int)$min, (int)$max]);
        } else {
            // If using price_min / price_max fallback
            if ($request->filled('price_min')) {
                $query->where('price', '>=', $request->price_min);
            }
            if ($request->filled('price_max')) {
                $query->where('price', '<=', $request->price_max);
            }
        }

        // Filter: Date Availability
        if ($request->filled('pickup_date')) {
            $query->whereDate('available_from', '<=', $request->pickup_date);
        }
        if ($request->filled('dropoff_date')) {
            $query->whereDate('available_until', '>=', $request->dropoff_date);
        }

        // Sorting
        if ($request->filled('sort_by')) {
            switch ($request->sort_by) {
                case 'price_asc':
                    $query->orderBy('price', 'asc');
                    break;
                case 'price_desc':
                    $query->orderBy('price', 'desc');
                    break;
                case 'latest':
                    $query->orderBy('created_at', 'desc');
                    break;
            }
        }
        
        $cars = $query->paginate(6)->appends($request->query());

        $today = Carbon::today();
        $bookedCarIds = Booking::whereIn('status', ['booked', 'in use', 'not collected', 'not returned'])
            ->where('end_date', '>=', $today)
            ->pluck('car_id')
            ->toArray();

        // Override car availability based on active bookings
        foreach ($cars as $car) {
            if (in_array($car->id, $bookedCarIds)) {
                $car->availability = false;
            }
}

        // For dropdowns (distinct values)
        $brands = Car::select('brand')->distinct()->pluck('brand');
        $models = Car::select('model')->distinct()->pluck('model');
        $types = Car::select('car_type')->distinct()->pluck('car_type');
        $transmissions = Car::select('transmission_type')->distinct()->pluck('transmission_type');
        $fuelTypes = Car::select('fuel_type')->distinct()->pluck('fuel_type');
        $capacities = Car::select('passenger_capacity')->distinct()->pluck('passenger_capacity');

        return view('listing', compact(
            'cars',
            'brands',
            'models',
            'types',
            'transmissions',
            'fuelTypes',
            'capacities'
        ));
    }


        public function getCarOptions(Request $request)
    {
        $brand = $request->query('brand');

        $models = Car::where('brand', $brand)->pluck('model')->unique()->values();
        $types = Car::where('brand', $brand)->pluck('car_type')->unique()->values();
        $fuelTypes = Car::where('brand', $brand)->pluck('fuel_type')->unique()->values();
        $transmissions = Car::where('brand', $brand)->pluck('transmission_type')->unique()->values();

        return response()->json([
            'models' => $models,
            'types' => $types,
            'fuelTypes' => $fuelTypes,
            'transmissions' => $transmissions,
        ]);
    }

        public function welcome()
    {
        $brands = Car::select('brand')->distinct()->pluck('brand');
        $models = Car::select('model')->distinct()->pluck('model');
        $pickupLocations = Car::select('pickup_location')->distinct()->pluck('pickup_location');

        return view('welcome', compact('brands', 'models', 'pickupLocations'));
    }

}
