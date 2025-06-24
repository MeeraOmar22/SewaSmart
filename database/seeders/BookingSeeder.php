<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Booking;

class BookingSeeder extends Seeder
{
    public function run(): void
    {
        Booking::create([
            'user_id' => 1,
            'car_id' => 2,
            'car_plate' => 'DEE3103',
            'start_date' => '2025-07-03',
            'end_date' => '2025-07-08',
            'status' => 'booked',
            'pic_name' => 'John Doe',
            'contact_no' => '012-3456789',
            'price' => 200.30,
            'verification_code' => 149901,
            'full_name' => 'John Doe', // ← ✅ ADD THIS
            'email' => 'demo@email.com', // ← ✅ ADD THIS
            'license_no' => 'ABC123456', // ← ✅ ADD THIS
            'license_expiry' => '2026-01-01', // ← ✅ Add this too if your DB requires
             'pickup_location'   => 'Kuching', // ← Add this
        ]);

        Booking::create([
            'user_id' => 1,
            'car_id' => 5,
            'car_plate'=>'WIE2003',
            'start_date' => now()->subDays(1)->format('Y-m-d'),
            'end_date' => now()->addDays(4)->format('Y-m-d'),
            'status' => 'in use',
            'pic_name' => 'John Doe',
            'contact_no' => '012-3456789',
            'price'=>300.50,
            'verification_code'=>rand(100000, 999999),
            'full_name' => 'John Doe',
            'email' => 'demo@email.com',
            'license_no' => 'ABC123456',
            'license_expiry' => '2026-01-01',
            'pickup_location' => 'Penang',


        ]);

        Booking::create([
            'user_id' => 1,
            'car_id' => 1,
            'car_plate'=>'WAE2003',
            'start_date' => now()->subDays(7)->format('Y-m-d'),
            'end_date' => now()->subDays(4)->format('Y-m-d'),
            'status' => 'returned',
            'pic_name' => 'Jane Smith',
            'contact_no' => '013-9876543',
            'feedback' => 'Great experience!',
            'rating' => 4,
            'price'=>300.50,
            'verification_code'=>rand(100000, 999999),
            'full_name' => 'John Doe',
            'email' => 'demo@email.com',
            'license_no' => 'ABC123456',
            'license_expiry' => '2026-01-01',
            'pickup_location' => 'Penang',
        ]);

        Booking::create([
            'user_id' => 1,
            'car_id' => 3,
            'car_plate'=>'WCE2003',
            'start_date' => now()->subDays(15)->format('Y-m-d'),
            'end_date' => now()->subDays(10)->format('Y-m-d'),
            'status' => 'returned',
            'pic_name' => 'Jane Smith',
            'contact_no' => '013-9876543',
            'price'=>300.50,
            'verification_code'=>rand(100000, 999999),
            'full_name' => 'John Doe',
            'email' => 'demo@email.com',
            'license_no' => 'ABC123456',
            'license_expiry' => '2026-01-01',
            'pickup_location' => 'Penang',
        ]);

        Booking::create([
            'user_id' => 1,
            'car_id' => 3,
            'car_plate'=>'WCE2003',
            'start_date' => now()->subDays(25)->format('Y-m-d'),
            'end_date' => now()->subDays(20)->format('Y-m-d'),
            'status' => 'not returned',
            'pic_name' => 'Jane Smith',
            'contact_no' => '013-9876543',
            'price'=>300.50,
            'verification_code'=>rand(100000, 999999),
            'penalty'=>'150',
            'full_name' => 'John Doe',
            'email' => 'demo@email.com',
            'license_no' => 'ABC123456',
            'license_expiry' => '2026-01-01',
            'pickup_location' => 'Penang',
        ]);

        Booking::create([
            'user_id' => 1,
            'car_id' => 3,
            'car_plate'=>'WCE2003',
            'start_date' => now()->subDays(25)->format('Y-m-d'),
            'end_date' => now()->subDays(20)->format('Y-m-d'),
            'status' => 'not collected',
            'pic_name' => 'Jane Smith',
            'contact_no' => '013-9876543',
            'price'=>300.50,
            'verification_code'=>rand(100000, 999999),
            'full_name' => 'John Doe',
            'email' => 'demo@email.com',
            'license_no' => 'ABC123456',
            'license_expiry' => '2026-01-01',
            'pickup_location' => 'Penang',
        ]);
    }
}