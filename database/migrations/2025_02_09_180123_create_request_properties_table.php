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
        Schema::create('request_properties', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('property_type');
            $table->string('property_status');
            $table->string('budget');
            $table->string('phone');
            $table->string('bedroom')->nullable();
            $table->string('email');
            $table->string('person');
            $table->string('comment');
            $table->unsignedBigInteger('country_id');
            $table->unsignedBigInteger('state_id');
            $table->unsignedBigInteger('city_id');

            $table->foreign('country_id')
            ->references('id')->on('countries')
            ->onDelete('cascade');
        $table->foreign('state_id')
            ->references('id')->on('states')
            ->onDelete('cascade');
        $table->foreign('city_id')
            ->references('id')->on('cities')
            ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('request_properties');
    }
};
