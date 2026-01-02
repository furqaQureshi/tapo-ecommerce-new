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
        Schema::create('cities', function (Blueprint $table) {
            $table->id();
            $table->string('name')->index(); // City name with index for faster queries
            $table->string('state')->nullable(); // State or region
            $table->decimal('latitude', 10, 7)->nullable(); // Latitude for geolocation
            $table->decimal('longitude', 10, 7)->nullable(); // Longitude for geolocation
            $table->integer('population')->nullable(); // Population, if needed
            $table->string('timezone')->nullable(); // Timezone, e.g., Asia/Kuala_Lumpur
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cities');
    }
};
