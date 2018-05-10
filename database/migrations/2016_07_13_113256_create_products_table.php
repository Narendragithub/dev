<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('name');
            $table->integer('qty')->unsigned();
            $table->string('sku');
            $table->decimal('price', 10, 4)->unsigned();
            $table->decimal('reduced_price', 10, 4)->unsigned()->nullable();
            $table->integer('categories_id')->unsigned();
            $table->integer('version_id')->unsigned();
            $table->integer('expiry')->unsigned();
            $table->text('description');
            $table->text('product_spec')->nullable();
            $table->timestamp('deleted_at')->nullable();    
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
        Schema::drop('products');
    }
}
