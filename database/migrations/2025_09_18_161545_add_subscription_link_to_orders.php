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
            $table->string('subscription_frequency')->nullable()->after('grand_total');
            $table->timestamp('subscription_start_at')->nullable()->after('subscription_frequency');
            $table->timestamp('subscription_expire_at')->nullable()->after('subscription_start_at');
            $table->string('subscription_link')->nullable()->after('subscription_expire_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn([
                'subscription_frequency',
                'subscription_start_at',
                'subscription_expire_at',
                'subscription_link'
            ]);
        });
    }
};
