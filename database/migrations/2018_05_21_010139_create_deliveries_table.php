<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDeliveriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deliveries', function (Blueprint $table) {
            $table->increments('id');
            $table->string('user_id');
            $table->string('name');
            $table->string('postal_code');
            $table->string('state');
            $table->string('city');
            $table->string('street');
            $table->string('building');
            $table->string('tel');
            $table->timestamps();


            // $table->primary('id');

            // $table->foreign('id')
            //        ->references('delivery_to_id')
            //        ->on('orders')
            //        ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('deliveries');
    }
}
