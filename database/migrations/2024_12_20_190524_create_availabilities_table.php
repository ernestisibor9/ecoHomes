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
        Schema::create('availabilities', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('property_id')->unsigned();
            // $table->datetime('start_time'); // Use datetime for date and time
            // $table->datetime('end_time');   // Use datetime for date and time
            $table->date('start_date');   // Store only the date
            $table->date('end_date');  // Store the end date
            $table->time('start_time');   // Store only the time
            $table->time('end_time');
            $table->foreign('property_id')
                ->references('id')->on('properties')
                ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('availabilities');
    }
};
