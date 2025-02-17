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
        Schema::create('multi_photo_shortlets', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('shortlet_id');
            $table->unsignedBigInteger('room_shortlet_id');
            $table->string('multi_photo_name');
            $table->timestamps();

            $table->foreign('shortlet_id')->references('id')->on('room_shortlets')->onDelete('cascade');
            $table->foreign('room_shortlet_id')->references('id')->on('room_shortlets')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('multi_photo_shortlets');
    }
};
