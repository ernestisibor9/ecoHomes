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
        Schema::create('cover_photo_shortlets', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('shortlet_id');
            $table->unsignedBigInteger('room_id');
            $table->string('photo_name');
            $table->timestamps();

            $table->foreign('shortlet_id')->references('id')->on('shortlets')->onDelete('cascade');
            $table->foreign('room_id')->references('id')->on('room_shortlets')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cover_photo_shortlets');
    }
};
