<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id('event_id');
            $table->string('event_category');
            $table->string('event_title');
            $table->text('event_description')->nullable();
            $table->dateTime('event_date');
            $table->string('event_image')->nullable();
            $table->string('event_city');
            $table->string('event_address');
            $table->string('event_status')->default('Upcoming');
            $table->timestamp('event_created_on')->useCurrent();
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
        Schema::dropIfExists('events');
    }
}
