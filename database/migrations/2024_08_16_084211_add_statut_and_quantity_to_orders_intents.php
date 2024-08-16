<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStatutAndQuantityToOrdersIntents extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders_intents', function (Blueprint $table) {
            $table->string('statut')->default('pending');
            $table->integer('quantity')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders_intents', function (Blueprint $table) {
            $table->dropColumn('statut');
            $table->dropColumn('quantity');
        });
    }
}
