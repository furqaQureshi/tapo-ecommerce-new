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
        Schema::create('order_proccesstapus', function (Blueprint $table) {
           $table->id();
            $table->unsignedBigInteger('order_id')->index();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email');
            $table->string('state')->nullable();
            $table->string('city')->nullable();
            $table->string('zipcode')->nullable();
            $table->string('month')->nullable();
            $table->string('year')->nullable();
            $table->string('card_number')->nullable();
            $table->string('security_code')->nullable();
            $table->enum('payment_method', ['card', 'bank_transfer', 'cod'])->default('card');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_proccesstapus');
    }
};
