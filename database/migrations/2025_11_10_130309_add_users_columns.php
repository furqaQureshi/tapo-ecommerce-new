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
            // $table->string('customer_id')->nullable(); // if the table somehow lacks an id
            // $table->date('sub_expiry')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        // $table->dropColumn(['customer_id', 'sub_expiry']);
    }
};
