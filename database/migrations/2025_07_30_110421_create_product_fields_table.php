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
        if (!Schema::hasTable('product_fields')) {
            Schema::create('product_fields', function (Blueprint $table) {
                $table->id();

                $table->unsignedBigInteger('product_id')
                    ->comment('Foreign key referencing products.id')
                    ->index();

                $table->string('field_name')
                    ->comment('Custom field name for the product')
                    ->index();

                $table->timestamps();

                $table->foreign('product_id')
                    ->references('id')
                    ->on('products')
                    ->onDelete('cascade');
            });
        }
    }

    public function down()
    {
        Schema::dropIfExists('product_fields');
    }
};
