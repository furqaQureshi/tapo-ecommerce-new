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
            $table->string('subscription_status')->nullable();
            $table->integer('paid_count')->default(0);
            $table->integer('remaining_count')->nullable();
            $table->timestamp('next_charge_at')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn(['subscription_status', 'paid_count', 'remaining_count', 'next_charge_at']);
        });
    }
};
