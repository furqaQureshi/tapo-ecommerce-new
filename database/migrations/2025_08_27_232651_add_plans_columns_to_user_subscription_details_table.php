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
        Schema::table('user_subscription_details', function (Blueprint $table) {
            $table->date('renewal_date')->nullable()->after('number_of_children');
            $table->string('bundle_plan_name')->nullable()->after('renewal_date');
            $table->decimal('bundle_plan_price', 10, 2)->nullable()->after('bundle_plan_name');
            $table->unsignedBigInteger('plan_id')->nullable()->after('bundle_plan_price');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('user_subscription_details', function (Blueprint $table) {
            $table->dropColumn(['bundle_plan_name', 'bundle_plan_price', 'plan_id', 'renewal_date']);
        });
    }
};
