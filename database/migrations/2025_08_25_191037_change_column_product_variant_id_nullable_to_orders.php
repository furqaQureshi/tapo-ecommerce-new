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
        // First, drop the foreign key constraint
        Schema::table('order_items', function (Blueprint $table) {
            // $table->dropForeign('product_variant_id');
            // $table->bigInteger('product_variant_id')->nullable()->change();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void {}
};
