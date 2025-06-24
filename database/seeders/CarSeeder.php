<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Car;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class CarSeeder extends Seeder
{
    public function run()
    {
    // Disable FK checks just in case
    // DB::statement('SET FOREIGN_KEY_CHECKS=0;');

    // // Safer deletion
    // Car::query()->delete();

    // DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        $cars = [
            // (same array as you already wrote above, without 'car_plate' yet)
            ['brand' => 'Toyota', 'model' => 'Camry', 'transmission_type' => 'Automatic', 'fuel_type' => 'Petrol', 'passenger_capacity' => 4, 'price' => 1125.14, 'availability' => true, 'car_type' => 'Sedan', 'pickup_location' => 'Kuching', 'available_from' => Carbon::parse('2025-06-23'), 'available_until' => Carbon::parse('2025-08-06')],
            ['brand' => 'Honda', 'model' => 'CR-V', 'transmission_type' => 'Manual', 'fuel_type' => 'Diesel', 'passenger_capacity' => 7, 'price' => 1716.35, 'availability' => true, 'car_type' => 'SUV', 'pickup_location' => 'Selangor', 'available_from' => Carbon::parse('2025-06-23'), 'available_until' => Carbon::parse('2025-09-18')],
            ['brand' => 'Ford', 'model' => 'Mustang', 'transmission_type' => 'Automatic', 'fuel_type' => 'Diesel', 'passenger_capacity' => 5, 'price' => 1156.31, 'availability' => true, 'car_type' => 'Coupe', 'pickup_location' => 'Penang', 'available_from' => Carbon::parse('2025-06-23'), 'available_until' => Carbon::parse('2025-08-11')],
            ['brand' => 'BMW', 'model' => 'X5', 'transmission_type' => 'Automatic', 'fuel_type' => 'Electric', 'passenger_capacity' => 5, 'price' => 1426.50, 'availability' => true, 'car_type' => 'SUV', 'pickup_location' => 'Penang', 'available_from' => Carbon::parse('2025-06-23'), 'available_until' => Carbon::parse('2025-09-16')],
            ['brand' => 'Nissan', 'model' => 'Almera', 'transmission_type' => 'Automatic', 'fuel_type' => 'Electric', 'passenger_capacity' => 7, 'price' => 1720.13, 'availability' => true, 'car_type' => 'Sedan', 'pickup_location' => 'Kota Kinabalu', 'available_from' => Carbon::parse('2025-06-23'), 'available_until' => Carbon::parse('2025-08-30')],
            ['brand' => 'Hyundai', 'model' => 'Tucson', 'transmission_type' => 'Manual', 'fuel_type' => 'Petrol', 'passenger_capacity' => 7, 'price' => 1500.45, 'availability' => true, 'car_type' => 'SUV', 'pickup_location' => 'Johor Bahru', 'available_from' => Carbon::parse('2025-06-23'), 'available_until' => Carbon::parse('2025-09-02')],
            ['brand' => 'Mercedes', 'model' => 'C-Class', 'transmission_type' => 'Automatic', 'fuel_type' => 'Hybrid', 'passenger_capacity' => 5, 'price' => 1340.29, 'availability' => true, 'car_type' => 'Sedan', 'pickup_location' => 'Selangor', 'available_from' => Carbon::parse('2025-06-23'), 'available_until' => Carbon::parse('2025-08-25')],
            ['brand' => 'Kia', 'model' => 'Sportage', 'transmission_type' => 'Manual', 'fuel_type' => 'Diesel', 'passenger_capacity' => 5, 'price' => 1270.00, 'availability' => true, 'car_type' => 'SUV', 'pickup_location' => 'Penang', 'available_from' => Carbon::parse('2025-06-23'), 'available_until' => Carbon::parse('2025-09-09')],
            ['brand' => 'Mazda', 'model' => 'CX-5', 'transmission_type' => 'Automatic', 'fuel_type' => 'Petrol', 'passenger_capacity' => 5, 'price' => 1180.20, 'availability' => true, 'car_type' => 'SUV', 'pickup_location' => 'Kuala Lumpur', 'available_from' => Carbon::parse('2025-06-23'), 'available_until' => Carbon::parse('2025-08-20')],
            ['brand' => 'Chevrolet', 'model' => 'Captiva', 'transmission_type' => 'Automatic', 'fuel_type' => 'Diesel', 'passenger_capacity' => 7, 'price' => 1295.70, 'availability' => true, 'car_type' => 'SUV', 'pickup_location' => 'Kota Kinabalu', 'available_from' => Carbon::parse('2025-06-23'), 'available_until' => Carbon::parse('2025-09-10')],
            ['brand' => 'Volkswagen', 'model' => 'Golf', 'transmission_type' => 'Manual', 'fuel_type' => 'Petrol', 'passenger_capacity' => 5, 'price' => 980.99, 'availability' => true, 'car_type' => 'Hatchback', 'pickup_location' => 'Kuala Lumpur', 'available_from' => Carbon::parse('2025-06-23'), 'available_until' => Carbon::parse('2025-08-22')],
            ['brand' => 'Peugeot', 'model' => '3008', 'transmission_type' => 'Automatic', 'fuel_type' => 'Diesel', 'passenger_capacity' => 5, 'price' => 1080.35, 'availability' => true, 'car_type' => 'SUV', 'pickup_location' => 'Penang', 'available_from' => Carbon::parse('2025-06-23'), 'available_until' => Carbon::parse('2025-08-27')],
            ['brand' => 'Tesla', 'model' => 'Model 3', 'transmission_type' => 'Automatic', 'fuel_type' => 'Electric', 'passenger_capacity' => 5, 'price' => 1600.00, 'availability' => true, 'car_type' => 'Sedan', 'pickup_location' => 'Kuching', 'available_from' => Carbon::parse('2025-06-23'), 'available_until' => Carbon::parse('2025-09-17')],
            ['brand' => 'Toyota', 'model' => 'Vios', 'transmission_type' => 'Manual', 'fuel_type' => 'Petrol', 'passenger_capacity' => 5, 'price' => 860.75, 'availability' => true, 'car_type' => 'Sedan', 'pickup_location' => 'Selangor', 'available_from' => Carbon::parse('2025-06-23'), 'available_until' => Carbon::parse('2025-08-24')],
            ['brand' => 'Honda', 'model' => 'City', 'transmission_type' => 'Automatic', 'fuel_type' => 'Petrol', 'passenger_capacity' => 5, 'price' => 910.00, 'availability' => true, 'car_type' => 'Sedan', 'pickup_location' => 'Johor Bahru', 'available_from' => Carbon::parse('2025-06-23'), 'available_until' => Carbon::parse('2025-09-06')],
            ['brand' => 'Lamborghini', 'model' => 'Huracan', 'transmission_type' => 'Automatic', 'fuel_type' => 'Petrol', 'passenger_capacity' => 2, 'price' => 1750.00, 'availability' => true, 'car_type' => 'Sports', 'pickup_location' => 'Kuala Lumpur', 'available_from' => Carbon::parse('2025-06-23'), 'available_until' => Carbon::parse('2025-09-15')],
            ['brand' => 'Ferrari', 'model' => '488 GTB', 'transmission_type' => 'Automatic', 'fuel_type' => 'Petrol', 'passenger_capacity' => 2, 'price' => 1800.00, 'availability' => true, 'car_type' => 'Sports', 'pickup_location' => 'Penang', 'available_from' => Carbon::parse('2025-06-23'), 'available_until' => Carbon::parse('2025-08-29')],
            ['brand' => 'Audi', 'model' => 'Q7', 'transmission_type' => 'Automatic', 'fuel_type' => 'Diesel', 'passenger_capacity' => 7, 'price' => 1380.00, 'availability' => true, 'car_type' => 'SUV', 'pickup_location' => 'Kuching', 'available_from' => Carbon::parse('2025-06-23'), 'available_until' => Carbon::parse('2025-08-31')],
            ['brand' => 'Volvo', 'model' => 'XC60', 'transmission_type' => 'Automatic', 'fuel_type' => 'Hybrid', 'passenger_capacity' => 5, 'price' => 1200.00, 'availability' => true, 'car_type' => 'SUV', 'pickup_location' => 'Johor Bahru', 'available_from' => Carbon::parse('2025-06-23'), 'available_until' => Carbon::parse('2025-08-28')],
            ['brand' => 'Mitsubishi', 'model' => 'Outlander', 'transmission_type' => 'Manual', 'fuel_type' => 'Petrol', 'passenger_capacity' => 7, 'price' => 1100.00, 'availability' => true, 'car_type' => 'SUV', 'pickup_location' => 'Selangor', 'available_from' => Carbon::parse('2025-06-23'), 'available_until' => Carbon::parse('2025-09-05')],
            ['brand' => 'Proton', 'model' => 'Saga', 'transmission_type' => 'Automatic', 'fuel_type' => 'Petrol', 'passenger_capacity' => 5, 'price' => 650.00, 'availability' => true, 'car_type' => 'Sedan', 'pickup_location' => 'Penang', 'available_from' => Carbon::parse('2025-06-23'), 'available_until' => Carbon::parse('2025-09-01')],
            ['brand' => 'Perodua', 'model' => 'Bezza', 'transmission_type' => 'Automatic', 'fuel_type' => 'Petrol', 'passenger_capacity' => 5, 'price' => 680.00, 'availability' => true, 'car_type' => 'Sedan', 'pickup_location' => 'Kuala Lumpur', 'available_from' => Carbon::parse('2025-06-23'), 'available_until' => Carbon::parse('2025-08-23')],
            ['brand' => 'Chery', 'model' => 'Tiggo 8', 'transmission_type' => 'Automatic', 'fuel_type' => 'Petrol', 'passenger_capacity' => 7, 'price' => 1250.00, 'availability' => true, 'car_type' => 'SUV', 'pickup_location' => 'Selangor', 'available_from' => Carbon::parse('2025-06-23'), 'available_until' => Carbon::parse('2025-09-03')],
            ['brand' => 'Lexus', 'model' => 'RX', 'transmission_type' => 'Automatic', 'fuel_type' => 'Hybrid', 'passenger_capacity' => 5, 'price' => 1440.00, 'availability' => true, 'car_type' => 'SUV', 'pickup_location' => 'Kuching', 'available_from' => Carbon::parse('2025-06-23'), 'available_until' => Carbon::parse('2025-09-13')],
            ['brand' => 'Honda', 'model' => 'Jazz', 'transmission_type' => 'Manual', 'fuel_type' => 'Petrol', 'passenger_capacity' => 5, 'price' => 860.00, 'availability' => true, 'car_type' => 'Hatchback', 'pickup_location' => 'Johor Bahru', 'available_from' => Carbon::parse('2025-06-23'), 'available_until' => Carbon::parse('2025-09-08')],
            ['brand' => 'Renault', 'model' => 'Koleos', 'transmission_type' => 'Automatic', 'fuel_type' => 'Petrol', 'passenger_capacity' => 5, 'price' => 1120.00, 'availability' => true, 'car_type' => 'SUV', 'pickup_location' => 'Penang', 'available_from' => Carbon::parse('2025-06-23'), 'available_until' => Carbon::parse('2025-09-04')],
            ['brand' => 'Subaru', 'model' => 'Forester', 'transmission_type' => 'Manual', 'fuel_type' => 'Petrol', 'passenger_capacity' => 5, 'price' => 1150.00, 'availability' => true, 'car_type' => 'SUV', 'pickup_location' => 'Kuala Lumpur', 'available_from' => Carbon::parse('2025-06-23'), 'available_until' => Carbon::parse('2025-09-07')],
            ['brand' => 'Mini', 'model' => 'Cooper', 'transmission_type' => 'Automatic', 'fuel_type' => 'Petrol', 'passenger_capacity' => 4, 'price' => 1220.00, 'availability' => true, 'car_type' => 'Hatchback', 'pickup_location' => 'Selangor', 'available_from' => Carbon::parse('2025-06-23'), 'available_until' => Carbon::parse('2025-08-26')],
            ['brand' => 'Jeep', 'model' => 'Wrangler', 'transmission_type' => 'Manual', 'fuel_type' => 'Diesel', 'passenger_capacity' => 5, 'price' => 1350.00, 'availability' => true, 'car_type' => 'SUV', 'pickup_location' => 'Penang', 'available_from' => Carbon::parse('2025-06-23'), 'available_until' => Carbon::parse('2025-08-19')],
            ['brand' => 'Toyota', 'model' => 'Fortuner', 'transmission_type' => 'Automatic', 'fuel_type' => 'Diesel', 'passenger_capacity' => 7, 'price' => 1390.00, 'availability' => true, 'car_type' => 'SUV', 'pickup_location' => 'Johor Bahru', 'available_from' => Carbon::parse('2025-06-23'), 'available_until' => Carbon::parse('2025-09-12')],
        ];

    foreach ($cars as $car) {
    $car['car_plate'] = $this->generatePlate(); // inject plate here
    Car::create($car);
}
    }

    private function generatePlate()
    {
        // Example: WAB 1234 or SAB 9021
        $prefixes = ['W', 'S', 'B', 'J', 'P', 'K', 'M', 'T', 'A'];
        $second = chr(rand(65, 90)); // A-Z
        $third = chr(rand(65, 90)); // A-Z
        $numbers = rand(1000, 9999);

        return $prefixes[array_rand($prefixes)] . $second . $third . ' ' . $numbers;
    }
}

