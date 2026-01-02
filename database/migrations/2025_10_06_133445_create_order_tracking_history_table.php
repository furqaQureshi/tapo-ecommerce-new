<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('order_tracking_history', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id');
            $table->string('tracking_no');
            $table->string('process');
            $table->string('type')->nullable();
            $table->dateTime('date')->nullable();
            $table->string('office')->nullable();
            $table->string('error_details')->nullable();
            $table->string('event_type')->nullable();
            $table->string('failure_reason')->nullable();
            $table->string('epod')->nullable();
            $table->string('source')->nullable();
            $table->timestamps();

            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
            $table->unique(['order_id', 'process']); // Prevent duplicate process for same order
        });
    }

    public function down()
    {
        Schema::dropIfExists('order_tracking_history');
    }
};
