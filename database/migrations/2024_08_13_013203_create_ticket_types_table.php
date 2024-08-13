<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTicketTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ticket_types', function (Blueprint $table) {
            $table->increments('ticket_type_id');
            $table->integer('ticket_type_event_id')->unsigned();
            $table->string('ticket_type_name', 50);
            $table->mediumInteger('ticket_type_price');
            $table->integer('ticket_type_quantity');
            $table->integer('ticket_type_real_quantity');
            $table->integer('ticket_type_total_quantity');
            $table->mediumText('ticket_type_description');
            $table->timestamps();

            // Foreign key constraint
            $table->foreign('ticket_type_event_id')->references('event_id')->on('events')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ticket_types');
    }
}
