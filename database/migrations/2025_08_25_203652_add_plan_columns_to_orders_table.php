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
        Schema::table('orders', function (Blueprint $table) {
            $table->tinyInteger('type')->default(0)->nullable()->after('order_number');
            $table->string('bundle_plan_name')->nullable();
            $table->decimal('bundle_plan_price', 10, 2)->nullable();
            $table->unsignedBigInteger('plan_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn(['bundle_plan_name', 'bundle_plan_price', 'plan_id']);
        });
    }
};
