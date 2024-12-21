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
        Schema::create('viewing_requests', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->unsignedBigInteger('user_id')->unsigned()->nullable();
            $table->unsignedBigInteger('property_id')->unsigned(); //requested_date
            $table->date('requested_date');
            $table->time('requested_time'); // Use datetime for date and time
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->foreign('property_id')
                ->references('id')->on('properties')
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
        Schema::dropIfExists('viewing_requests');
    }
};
