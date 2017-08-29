<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTicketBoxTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ticket_box_tickets', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('event_id');
            $table->integer('ticket_box_id');
            $table->integer('ticket_period_id');
            $table->integer('ticket_class_id');
            $table->string('ticket_code', 50);
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
        Schema::dropIfExists('ticket_box_tickets');
    }
}
