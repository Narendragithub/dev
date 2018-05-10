<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_product', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('order_id')->unsigned();
            $table->integer('product_id')->unsigned();
            $table->integer('version_id')->unsigned();
            $table->integer('qty')->unsigned();
            $table->decimal('price', 10, 4)->unsigned();
            $table->decimal('reduced_price', 10, 4)->unsigned();
            $table->decimal('total', 10, 4)->unsigned();
            $table->decimal('total_reduced', 10, 4)->unsigned();
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
        Schema::drop('order_product');
    }
}
