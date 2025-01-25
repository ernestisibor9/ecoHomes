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
        Schema::create('shortlets', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->unsigned();
            $table->string('shortlet_name'); // Hotel name
            $table->text('address'); // Detailed address
            $table->string('postal_code')->nullable();
            $table->string('zip_code')->nullable(); // Optional zip/postal code
            $table->text('description')->nullable(); // Optional hotel description
            $table->string('channel_manager')->nullable();
            $table->string('number_of_shortlet')->nullable();
            $table->string('guest_facilities')->nullable();
            $table->string('language')->nullable();
            $table->string('children')->nullable();
            $table->string('pet')->nullable();
            $table->unsignedInteger('progress_step')->default(1); // Current progress step
            $table->foreign('user_id')
            ->references('id')->on('users')
            ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shortlets');
    }
};
