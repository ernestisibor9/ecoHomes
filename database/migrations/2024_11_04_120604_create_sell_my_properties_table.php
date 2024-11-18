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
        Schema::create('sell_my_properties', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->unsigned();
            $table->string('firstname');
            $table->string('lastname');
            $table->string('email');
            $table->string('phone');
            $table->string('country_id');
            $table->string('state_id')->nullable();
            $table->string('city_id')->nullable();
            $table->string('postal_code')->nullable();
            $table->string('multi_img')->nullable();
            // $table->string('video')->nullable();
            $table->text('description')->nullable();
            $table->enum('status', ['approved', 'rejected', 'pending'])->default('pending');
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
        Schema::dropIfExists('sell_my_properties');
    }
};
