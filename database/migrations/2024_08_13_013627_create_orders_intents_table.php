<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersIntentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders_intents', function (Blueprint $table) {
            $table->increments('order_intent_id');
            $table->mediumInteger('order_intent_price');
            $table->string('order_intent_type', 50);
            $table->string('user_email', 100);
            $table->string('user_phone', 20);
            $table->dateTime('expiration_date');
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
        Schema::dropIfExists('orders_intents');
    }
}
