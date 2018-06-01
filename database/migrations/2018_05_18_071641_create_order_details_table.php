<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_details', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('order_id');
            $table->unsignedInteger('item_id');
            $table->unsignedInteger('order_number');
            $table->unsignedInteger('notax_price');
            $table->unsignedInteger('intax_price');
            $table->timestamps();

            // $table->foreign('order_id')
            //        ->references('id')
            //        ->on('orders')
            //        ->onDelete('cascade');
            //
            // $table->foreign('product_id')
            //        ->references('id')
            //        ->on('products');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_details');
    }
}
