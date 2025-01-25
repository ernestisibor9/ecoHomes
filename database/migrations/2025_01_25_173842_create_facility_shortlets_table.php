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
        Schema::create('facility_shortlets', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('shortlet_id');
            $table->unsignedBigInteger('facility_id');

            // Foreign key to the hotels table
            $table->foreign('shortlet_id')->references('id')->on('shortlets')->onDelete('cascade');

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
        Schema::dropIfExists('facility_shortlets');
    }
};
