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
        //
          Schema::table('users', function (Blueprint $table) {
            // Add missing columns
            $table->string('first_name')->nullable(); // Adjust 'after' if needed
            $table->string('city')->nullable();
            $table->string('zip_code')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        $table->dropColumn(['first_name', 'city', 'zip_code']);
    }
};
