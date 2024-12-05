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
        Schema::create('notifications', function (Blueprint $table) {
            $table->uuid('id')->primary();  // Ensure UUID is used
            $table->string('type');
            $table->morphs('notifiable');  // Polymorphic relation for users, etc.
            $table->text('data');  // Store the notification data (like message)
            $table->timestamp('read_at')->nullable();  // Timestamp for when read
            $table->timestamps();  // Created at, updated at timestamps
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};
