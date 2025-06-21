<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Car;

class CarSeeder extends Seeder
{
    public function run()
    {
        $cars = [
            ['brand' => 'Toyota', 'model' => 'Camry', 'transmission_type' => 'Automatic', 'fuel_type' => 'Petrol', 'price' => 200.00, 'availability' => true],
            ['brand' => 'Honda', 'model' => 'CR-V', 'transmission_type' => 'Automatic', 'fuel_type' => 'Petrol', 'price' => 250.00, 'availability' => true],
            ['brand' => 'Ford', 'model' => 'Mustang', 'transmission_type' => 'Manual', 'fuel_type' => 'Petrol', 'price' => 450.00, 'availability' => true],
            ['brand' => 'BMW', 'model' => 'X5', 'transmission_type' => 'Automatic', 'fuel_type' => 'Diesel', 'price' => 500.00, 'availability' => true],
            ['brand' => 'Nissan', 'model' => 'Almera', 'transmission_type' => 'Automatic', 'fuel_type' => 'Petrol', 'price' => 180.00, 'availability' => true],
            ['brand' => 'Hyundai', 'model' => 'Tucson', 'transmission_type' => 'Automatic', 'fuel_type' => 'Diesel', 'price' => 270.00, 'availability' => true],
            ['brand' => 'Mercedes', 'model' => 'C-Class', 'transmission_type' => 'Automatic', 'fuel_type' => 'Petrol', 'price' => 550.00, 'availability' => true],
            ['brand' => 'Kia', 'model' => 'Sportage', 'transmission_type' => 'Manual', 'fuel_type' => 'Diesel', 'price' => 260.00, 'availability' => true],
            ['brand' => 'Mazda', 'model' => 'CX-5', 'transmission_type' => 'Automatic', 'fuel_type' => 'Petrol', 'price' => 290.00, 'availability' => true],
            ['brand' => 'Chevrolet', 'model' => 'Captiva', 'transmission_type' => 'Automatic', 'fuel_type' => 'Diesel', 'price' => 310.00, 'availability' => true],
            ['brand' => 'Volkswagen', 'model' => 'Golf', 'transmission_type' => 'Automatic', 'fuel_type' => 'Petrol', 'price' => 320.00, 'availability' => true],
            ['brand' => 'Peugeot', 'model' => '3008', 'transmission_type' => 'Automatic', 'fuel_type' => 'Diesel', 'price' => 300.00, 'availability' => true],
            ['brand' => 'Tesla', 'model' => 'Model 3', 'transmission_type' => 'Automatic', 'fuel_type' => 'Electric', 'price' => 600.00, 'availability' => true],
            ['brand' => 'Toyota', 'model' => 'Vios', 'transmission_type' => 'Manual', 'fuel_type' => 'Petrol', 'price' => 160.00, 'availability' => true],
            ['brand' => 'Honda', 'model' => 'City', 'transmission_type' => 'Automatic', 'fuel_type' => 'Petrol', 'price' => 170.00, 'availability' => true],
            ['brand' => 'Lamborghini', 'model' => 'Huracan', 'transmission_type' => 'Automatic', 'fuel_type' => 'Petrol', 'price' => 1500.00, 'availability' => true],
            ['brand' => 'Ferrari', 'model' => '488 GTB', 'transmission_type' => 'Automatic', 'fuel_type' => 'Petrol', 'price' => 1800.00, 'availability' => true],
            ['brand' => 'Audi', 'model' => 'Q7', 'transmission_type' => 'Automatic', 'fuel_type' => 'Diesel', 'price' => 520.00, 'availability' => true],
            ['brand' => 'Volvo', 'model' => 'XC60', 'transmission_type' => 'Automatic', 'fuel_type' => 'Petrol', 'price' => 480.00, 'availability' => true],
            ['brand' => 'Mitsubishi', 'model' => 'Outlander', 'transmission_type' => 'Manual', 'fuel_type' => 'Petrol', 'price' => 250.00, 'availability' => true],
            ['brand' => 'Proton', 'model' => 'Saga', 'transmission_type' => 'Automatic', 'fuel_type' => 'Petrol', 'price' => 100.00, 'availability' => true],
            ['brand' => 'Perodua', 'model' => 'Bezza', 'transmission_type' => 'Automatic', 'fuel_type' => 'Petrol', 'price' => 120.00, 'availability' => true],
            ['brand' => 'Chery', 'model' => 'Tiggo 8', 'transmission_type' => 'Automatic', 'fuel_type' => 'Petrol', 'price' => 270.00, 'availability' => true],
            ['brand' => 'Lexus', 'model' => 'RX', 'transmission_type' => 'Automatic', 'fuel_type' => 'Hybrid', 'price' => 550.00, 'availability' => true],
            ['brand' => 'Honda', 'model' => 'Jazz', 'transmission_type' => 'Manual', 'fuel_type' => 'Petrol', 'price' => 160.00, 'availability' => true],
            ['brand' => 'Renault', 'model' => 'Koleos', 'transmission_type' => 'Automatic', 'fuel_type' => 'Petrol', 'price' => 300.00, 'availability' => true],
            ['brand' => 'Subaru', 'model' => 'Forester', 'transmission_type' => 'Manual', 'fuel_type' => 'Petrol', 'price' => 290.00, 'availability' => true],
            ['brand' => 'Mini', 'model' => 'Cooper', 'transmission_type' => 'Automatic', 'fuel_type' => 'Petrol', 'price' => 400.00, 'availability' => true],
            ['brand' => 'Jeep', 'model' => 'Wrangler', 'transmission_type' => 'Manual', 'fuel_type' => 'Diesel', 'price' => 550.00, 'availability' => true],
            ['brand' => 'Toyota', 'model' => 'Fortuner', 'transmission_type' => 'Automatic', 'fuel_type' => 'Diesel', 'price' => 350.00, 'availability' => true],
        ];

        foreach ($cars as $car) {
            Car::create($car);
        }
    }
}
