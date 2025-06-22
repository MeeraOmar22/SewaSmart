<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Booking>
 */
class BookingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $start = now()->addDays(rand(1, 10));
        $end = (clone $start)->addDays(rand(1, 5));

        return [
            'user_id' => \App\Models\User::factory(),
            'car_id' => \App\Models\Car::factory(),
            'car_plate' => strtoupper($this->faker->bothify('???####')), // e.g. ABC-1234
            'start_date' => $start,
            'end_date' => $end,
            'status' => 'booked',
            'pic_name' => $this->faker->name,
            'contact_no' => $this->faker->phoneNumber,
            'price' => $this->faker->numberBetween(100, 500), // RM100 - RM500
            'verification_code' => rand(100000, 999999),
            'feedback' => $this->faker->sentence,
            'rating' => rand(1, 5),
            'penalty'=> rand(1, 5),
        ];
    }
}
