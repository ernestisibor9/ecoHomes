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
        Schema::create('room_shortlets', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('shortlet_id');
            $table->string('room_name');
            $table->string('number_of_guest');
            $table->string('number_of_rooms');
            $table->string('smoking');
            $table->string('bathroom_status');
            $table->integer('bed_count')->nullable();
            $table->string('bed_type');
            $table->boolean('is_available')->default(true);
            $table->text('description')->nullable();
            $table->string('guest_facilities')->nullable();
            $table->timestamps();

            $table->foreign('shortlet_id')->references('id')->on('shortlets')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('room_shortlets');
    }
};
