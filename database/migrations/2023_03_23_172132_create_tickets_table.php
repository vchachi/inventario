<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTicketsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('print_method');
            $table->integer('autoprint');
            $table->integer('head');
            $table->integer('barcode');
            $table->string('paper_size');
            $table->string('margin_top');
            $table->string('margin_right');
            $table->string('margin_bottom');
            $table->string('margin_left');
            $table->integer('ticket_edit');
            $table->boolean('hide_address');
            $table->boolean('hide_nifcif');
            $table->boolean('hide_phone');
            $table->boolean('hide_email');
            $table->boolean('hide_website');
            $table->boolean('hide_barcode');
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
        Schema::drop('tickets');
    }
}
