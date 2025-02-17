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
        Schema::create('shortlet_images', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('room_shortlet_id');
            $table->string('image_path')->nullable(); // Allow image_path to be nullable
            $table->timestamps();

            $table->foreign('room_shortlet_id')->references('id')->on('room_shortlets')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shortlet_images');
    }
};
