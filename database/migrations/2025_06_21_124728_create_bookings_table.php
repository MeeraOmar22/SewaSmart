<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();

            // Foreign keys
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('car_id')->constrained()->onDelete('cascade');

            // Basic info
            $table->string('car_plate');
            $table->string('full_name');
            $table->string('email');
            $table->string('address');

            // License info
            $table->string('license_no');
            $table->date('license_expiry');

            // Booking duration
            $table->date('start_date');
            $table->date('end_date');

            // Options
            $table->unsignedTinyInteger('additional_drivers')->default(0);
            $table->string('rental_option'); // e.g., full_day / half_day / hourly
            $table->integer('hours')->nullable();
            $table->string('extras')->nullable(); // e.g., child seat, etc.
            $table->string('insurance')->nullable();

            // Logistics
            $table->string('pickup_location');

            // Status & payment
            $table->string('status')->default('booked');
            $table->string('pic_name');
            $table->string('contact_no', 20);
            $table->float('price');
            $table->integer('verification_code');

            // Post-booking feedback
            $table->string('feedback')->nullable();
            $table->integer('rating')->nullable();
            $table->float('penalty')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
