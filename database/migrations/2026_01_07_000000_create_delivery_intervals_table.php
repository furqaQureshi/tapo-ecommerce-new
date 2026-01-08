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
        Schema::create('delivery_intervals', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('weeks')->unsigned();
            $table->boolean('is_default')->default(false);
            $table->timestamps();

            $table->unique('weeks');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('delivery_intervals');
    }
};
