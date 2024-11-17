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
            $table->string('firstname');
            $table->string('lastname');
            $table->string('email');
            $table->string('phone');
            $table->string('country_id');
            $table->string('state_id')->nullable();
            $table->string('city_id')->nullable();
            $table->string('postal_code')->nullable();
            $table->string('multi_img')->nullable();
            $table->text('description')->nullable();
            $table->string('progress')->default('0');
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
