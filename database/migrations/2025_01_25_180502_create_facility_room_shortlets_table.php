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
        Schema::create('facility_room_shortlets', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('room_shortlet_id');
            $table->unsignedBigInteger('facility_id');

            // Foreign key to the rooms table
            $table->foreign('room_shortlet_id')->references('id')->on('room_shortlets')->onDelete('cascade');

            // Foreign key to the facilities table
            $table->foreign('facility_id')->references('id')->on('facilities')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('facility_room_shortlets');
    }
};
