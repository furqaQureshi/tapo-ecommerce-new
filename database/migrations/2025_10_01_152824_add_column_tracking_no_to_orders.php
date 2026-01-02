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
            $table->string('tracking_no')->nullable()->after('order_number');
            $table->json('child_tracking_no')->nullable()->after('tracking_no');
            $table->string('tracking_url')->nullable()->after('child_tracking_no');
            $table->string('consignment_jpeg')->nullable()->after('tracking_url');
            $table->string('consignment_pdf')->nullable()->after('consignment_jpeg');
            $table->string('consignment_zpl')->nullable()->after('consignment_pdf');
            $table->string('routing_code')->nullable()->after('consignment_zpl');
            $table->decimal('estimated_cost', 8, 2)->nullable()->after('routing_code');
            $table->decimal('total_weight', 8, 2)->nullable()->after('estimated_cost');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn([
                'tracking_no',
                'child_tracking_no',
                'tracking_url',
                'consignment_jpeg',
                'consignment_pdf',
                'consignment_zpl',
                'routing_code',
                'estimated_cost',
                'total_weight'
            ]);
        });
    }
};
