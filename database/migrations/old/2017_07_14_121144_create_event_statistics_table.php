<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventStatisticsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('event_statistics', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('event_id')->unsigned();;
            $table->string('event_name');
            $table->integer('order_count')->unsigned();
            $table->integer('ticket_count')->unsigned();
            $table->integer('payment_conf_count')->unsigned();
            $table->integer('cs_count')->unsigned();
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
        Schema::dropIfExists('event_statistics');
    }
}
