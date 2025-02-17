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
        Schema::create('list_properties', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->unsigned();
            $table->string('property_title');
            $table->string('property_slug');
            $table->string('property_status');
            $table->string('bedroom')->nullable();
            $table->string('bathroom')->nullable();
            $table->string('toilet')->nullable();
            $table->string('property_type')->nullable();
            $table->string('property_variant')->nullable();
            $table->string('season')->nullable();

            $table->string('size')->nullable();
            $table->string('furnishing_status')->nullable();
            $table->string('guest_facilities')->nullable();
            $table->string('owner_phone');
            $table->string('owner_name');
            $table->decimal('price', 10, 2)->nullable();
            $table->string('property_thumbnail');
            $table->decimal('latitude', 10, 8)->nullable();
            $table->decimal('longitude', 11, 8)->nullable();
            $table->string('condition')->nullable();
            $table->string('floor')->nullable();

            $table->string('flood_risk')->nullable();
            $table->string('drainage_system')->nullable();
            $table->string('topography')->nullable();
            $table->string('road_access')->nullable();
            $table->string('fencing')->nullable();
            $table->string('property_code');
            $table->text('address'); // Detailed address
            $table->string('postal_code')->nullable();
            $table->text('description'); // Optional hotel description

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
        Schema::dropIfExists('list_properties');
    }
};
