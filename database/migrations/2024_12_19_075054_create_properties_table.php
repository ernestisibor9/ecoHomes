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
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->string('ptype_id');
            $table->string('amenities_id');
            $table->string('property_name');
            $table->string('property_slug');

            $table->string('property_code')->nullable();
            $table->string('property_status')->nullable();
            $table->decimal('price', 10, 2)->nullable();
            $table->decimal('lowest_price', 10, 2)->nullable();
            $table->decimal('maximum_price', 10, 2)->nullable();
            $table->string('property_thumbnail')->nullable();
            $table->text('short_description')->nullable();
            $table->text('long_description')->nullable();
            $table->string('bedrooms')->nullable();
            $table->string('bathrooms')->nullable();
            $table->string('property_video')->nullable();
            $table->string('garage')->nullable();

            $table->unsignedBigInteger('seller_id');
            $table->foreign('seller_id')
                ->references('id')->on('sell_my_properties')
                ->onDelete('cascade');

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
            $table->string('address')->nullable();
            $table->enum('verification_status', ['1', '0'])->default(1);
            $table->string('featured')->nullable();
            $table->string('hot')->nullable();
            $table->string('status')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('properties');
    }
};
