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
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('property_id')->unsigned();
            $table->date('check_in');
            $table->date('check_out');
            $table->integer('guest_adults');
            $table->integer('guest_children')->default(0);
            $table->integer('guest_infants')->default(0);
            $table->integer('guest_pets')->default(0);

            $table->foreign('property_id')
                ->references('id')->on('properties')
                ->onDelete('cascade');

            $table->timestamps();

            $table->unique(['property_id', 'check_in', 'check_out']); // Prevent overlapping bookings
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
