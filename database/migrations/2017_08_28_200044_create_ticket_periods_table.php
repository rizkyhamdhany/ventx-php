<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTicketPeriodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ticket_periods', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('event_id');
            $table->string('name', 50);
            $table->date('start_date');
            $table->date('end_date');
            $table->timestamps();
        });
        Schema::table('ticket_classes', function (Blueprint $table) {
            $table->integer('ticket_period_id')->after('event_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ticket_periods');
        Schema::table('ticket_classes', function($table) {
            $table->dropColumn('ticket_period_id');
        });
    }
}
