<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function(Blueprint $table){
          $table->increments('id');
           $table->integer('shopping_cart_id')->unsigned();
           $table->foreign('shopping_cart_id')->references('id')->on('shopping_carts');
           $table->string('shipment_info');
            $table->enum('edited',['yes','no'])->default('no');
           $table->string('status')->default('En proceso');
           $table->string('guide_number')->nullable(true);
           $table->integer('total');
           
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
         Schema::drop('orders');
    }
}
