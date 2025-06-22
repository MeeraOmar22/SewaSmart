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
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('car_id')->constrained()->onDelete('cascade');
            $table->string('car_plate');
            $table->date('start_date');
            $table->date('end_date');
            $table->string('status')->default('booked'); 
            $table->string('pic_name');
            $table->string('contact_no',20);
            $table->float('price');
            $table->integer('verification_code');
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
