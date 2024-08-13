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
            $table->increments('ticket_id');
            $table->integer('ticket_event_id')->unsigned();
            $table->string('ticket_email', 255);
            $table->string('ticket_phone', 20);
            $table->mediumInteger('ticket_price');
            $table->integer('ticket_order_id')->unsigned()->nullable();
            $table->string('ticket_key', 100)->unique();
            $table->integer('ticket_ticket_type_id')->unsigned();
            $table->enum('ticket_status', ['active', 'validated', 'expired', 'cancelled']);
            $table->timestamp('ticket_created_on')->useCurrent();

            // Foreign key constraints
            $table->foreign('ticket_event_id')->references('event_id')->on('events')->onDelete('cascade');
            $table->foreign('ticket_ticket_type_id')->references('ticket_type_id')->on('ticket_types')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tickets');
    }
}
