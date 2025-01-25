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
            $table->string('room_type');
            $table->string('number_of_guest');
            $table->string('guest_used');
            $table->string('smoking');
            $table->integer('room_capacity');
            $table->integer('bed_type');
            $table->integer('bathroom_item');
            $table->decimal('price_per_night', 10, 2);
            $table->boolean('is_available')->default(true);
            $table->text('description')->nullable();
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
