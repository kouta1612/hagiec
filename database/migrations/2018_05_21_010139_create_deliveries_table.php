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
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('status');
            $table->string('name');
            $table->string('tel');
            $table->string('postal_code');
            $table->string('state');
            $table->string('city');
            $table->string('street');
            $table->string('building');
            $table->timestamps();

            // $table->foreign('user_id')->references('id')->on('users');
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
