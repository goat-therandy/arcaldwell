<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * 
     * Intent of this table to is store weather preferences for users.
     * This could include settings like preferred temperature units, notification preferences, etc.
     * 
     * @return void
     */
    public function up(): void
    {
        Schema::create('weather_pref', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('temperature_unit')->default('fahrenheit'); // e.g., 'celsius', 'fahrenheit'
            $table->boolean('notifications_enabled')->default(false); // Weather notifications preference
            $table->string('location')->nullable(); // User's preferred location for weather updates
            $table->string('favorites')->nullable(); // JSON or comma-separated list of favorite locations
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('weather_pref');
    }
};
