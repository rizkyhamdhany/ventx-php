<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDailyOrderStatisticsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('daily_order_statistics', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('event_id')->unsigned();
            $table->string('event_name');
            $table->integer('count_ticket')->unsigned();
            $table->date('day');
            $table->integer('week')->unsigned();
            $table->integer('month')->unsigned();
            $table->index(['event_id', 'day']);
            $table->index(['event_id', 'week']);
            $table->index(['event_id', 'month']);
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
        Schema::dropIfExists('daily_order_statistics');
    }
}
