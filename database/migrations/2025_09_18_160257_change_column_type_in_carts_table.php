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
        Schema::table('carts', function (Blueprint $table) {
            // If the column already exists, drop it first
            if (Schema::hasColumn('carts', 'attribute_id')) {
                $table->dropForeign(['attribute_id']);
                $table->dropColumn('attribute_id');
            }

            // Add JSON column
            $table->json('attributes')->nullable()->after('product_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('carts', function (Blueprint $table) {
            // Drop JSON column
            $table->dropColumn('attributes');

            // Restore original attribute_id column
            $table->unsignedBigInteger('attribute_id')->nullable()->after('product_id');
            $table->foreign('attribute_id')->references('id')->on('product_attributes')->onDelete('set null');
        });
    }
};
