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
        Schema::table('product_order_point_logs', function (Blueprint $table) {
            $table->enum('status', ['earned', 'redeemed'])->default('earned')->after('points_earned');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('product_order_point_logs', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
};
