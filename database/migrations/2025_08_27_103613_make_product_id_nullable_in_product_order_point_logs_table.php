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
            // Drop the existing foreign key constraint
            $table->dropForeign(['product_id']);

            // Modify product_id to be nullable
            $table->unsignedBigInteger('product_id')->nullable()->change();

            // Re-add the foreign key constraint
            $table->foreign('product_id')
                ->references('id')
                ->on('products')
                ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('product_order_point_logs', function (Blueprint $table) {
            // Drop the foreign key constraint
            $table->dropForeign(['product_id']);

            // Revert product_id to not nullable
            $table->unsignedBigInteger('product_id')->nullable(false)->change();

            // Re-add the foreign key constraint without onDelete set null
            $table->foreign('product_id')
                ->references('id')
                ->on('products')
                ->onDelete('restrict');
        });
    }
};
