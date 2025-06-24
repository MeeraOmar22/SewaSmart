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
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->string('brand');
            $table->string('model');
            $table->string('car_plate')->unique();
            $table->string('transmission_type');
            $table->string('fuel_type');
            $table->unsignedTinyInteger('passenger_capacity');
            $table->decimal('price', 8, 2);
            $table->boolean('availability')->default(true);
            $table->string('car_type')->nullable(); // optional field
            $table->string('pickup_location')->nullable();
            $table->date('available_from')->nullable();
            $table->date('available_until')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cars');
    }
};
