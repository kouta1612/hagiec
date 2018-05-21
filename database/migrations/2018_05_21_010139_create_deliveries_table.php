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
            $table->unsignedInteger('id');
            $table->string('name');
            $table->string('address_state');
            $table->string('address_city');
            $table->string('address_street');
            $table->string('address_building');
            $table->timestamps();


            $table->primary('id');

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
