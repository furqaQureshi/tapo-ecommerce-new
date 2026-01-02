<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        // Alter the enum column to include 'failed'
        DB::statement("ALTER TABLE orders MODIFY COLUMN status ENUM('pending', 'processing', 'completed', 'cancelled', 'refunded', 'failed') NOT NULL DEFAULT 'pending'");
    }

    public function down()
    {
        // Remove 'failed' from enum and set any 'failed' statuses to 'cancelled'
        DB::table('orders')->where('status', 'failed')->update(['status' => 'cancelled']);
        DB::statement("ALTER TABLE orders MODIFY COLUMN status ENUM('pending', 'processing', 'completed', 'cancelled', 'refunded') NOT NULL DEFAULT 'pending'");
    }
};
