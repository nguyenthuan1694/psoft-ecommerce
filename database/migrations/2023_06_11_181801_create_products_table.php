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
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('sku')->unique()->index();
            $table->string('name')->index();
            $table->string('slug')->unique()->index();
            $table->string('thumbnail')->nullable();
            $table->longText('short_description')->nullable();
            $table->longText('long_description')->nullable();
            $table->integer('price')->default(0)->nullable();
            $table->integer('cost')->default(0)->nullable();
            $table->integer('stock')->default(0)->nullable();
            $table->string('mass');
            $table->string('made_in');
            $table->tinyInteger('status')->default(1);
            $table->tinyInteger('product_type')->default(0);
            $table->dateTime('date_available')->nullable();
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
        Schema::dropIfExists('products');
    }
};
