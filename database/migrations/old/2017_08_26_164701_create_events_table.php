<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->string('name', 100);
            $table->string('initial', 5);
            $table->string('organizer', 100);
            $table->text('logo_color');
            $table->text('logo_white');
            $table->text('background_pattern');
            $table->string('color_primary',20);
            $table->string('color_secondary',20);
            $table->string('color_accent',20);
            $table->date('date');
            $table->string('time');
            $table->text('location');
            $table->float('lat');
            $table->float('lon');
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
