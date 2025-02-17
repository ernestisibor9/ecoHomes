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
        Schema::create('report_listings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('list_property_id');
            $table->string('reason');
            $table->string('name');
            $table->string('email');
            $table->string('comment');

            $table->foreign('list_property_id')->references('id')->on('list_properties')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('report_listings');
    }
};
