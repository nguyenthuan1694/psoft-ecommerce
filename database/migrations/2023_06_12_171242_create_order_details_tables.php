<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('order_id');
            $table->unsignedBigInteger('product_id');
            $table->string('name');
            $table->integer('quantity')->default(0);
            $table->integer('price')->default(0);
            $table->integer('total_price')->default(0);
            $table->string('sku');
            $table->string('currency')->default('VND');
            $table->double('exchange_rate', 8, 2)->nullable();
            $table->string('attribute')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_details_tables');
    }
};
