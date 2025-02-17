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
        Schema::create('multi_photo_properties', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('list_property_id');
            $table->string('multi_photo_name');
            $table->timestamps();

            $table->foreign('list_property_id')->references('id')->on('list_properties')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('multi_photo_properties');
    }
};
