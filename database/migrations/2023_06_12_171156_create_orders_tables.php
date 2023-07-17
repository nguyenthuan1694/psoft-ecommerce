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
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('customer_id')->nullable();
            $table->string('fullname');
            $table->string('address');
            $table->string('country')->default('Vietnam');
            $table->string('phone');
            $table->string('email');
            $table->string('customer_agent')->nullable();
            $table->string('ip')->nullable();
            $table->dateTime('date')->useCurrent();
            $table->unsignedBigInteger('coupon_id')->nullable();
            $table->integer('payment_status')->default(1);
            $table->integer('shipping_status')->default(1);
            $table->integer('discount')->default(0);
            $table->integer('shipping')->default(0);
            $table->integer('tax')->default(0);
            $table->integer('subtotal')->default(0);
            $table->integer('total')->default(0);
            $table->integer('received')->default(0);
            $table->integer('balance')->default(0);
            $table->string('currency')->default('VND');
            $table->double('exchange_rate', 8, 2)->nullable();
            $table->integer('payment_method_id')->default(1);
            $table->integer('shipping_method_id')->default(1);
            $table->tinyInteger('status')->default(1);
            $table->string('note')->nullable();
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
        Schema::dropIfExists('orders_tables');
    }
};
