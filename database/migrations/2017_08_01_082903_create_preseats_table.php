<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePreseatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('preseats', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('preticket_id');
            $table->integer('seat_id');
            $table->string('seat_no', 10);
            $table->string('ticket_class', 20);
            $table->bigInteger('expire_time');
            $table->timestamp('expire_at');
            $table->string('status', 20);
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
        Schema::dropIfExists('preseats');
    }
}
