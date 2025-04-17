<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->increments('id');
            $table->string('title');
            $table->integer('category_id');
            $table->string('brand');
            $table->string('model');
            $table->string('color');
            $table->string('bar_code');
            $table->string('reference');
            $table->integer('units');
            $table->double('buy_price');
            $table->double('sell_price');
            $table->integer('invoicing');
            $table->integer('state');
            $table->integer('storage');
            $table->integer('warranty');
            $table->string('observations');
            $table->timestamps();
            $table->softDeletes();
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
