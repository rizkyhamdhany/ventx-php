<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSeatCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ticket_classes', function (Blueprint $table) {
            $table->integer('row')->after('desc');
            $table->integer('col')->after('row');
            $table->boolean('have_seat')->after('col');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ticket_classes', function (Blueprint $table) {
            $table->dropColumn(['row', 'col', 'have_seat']);
        });
    }
}
