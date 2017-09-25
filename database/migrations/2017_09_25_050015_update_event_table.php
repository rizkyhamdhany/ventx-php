<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateEventTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('events', function (Blueprint $table) {
          $table->text('eticket_layout')->after('pattern_footer');
          $table->text('invoice_layout')->after('eticket_layout');
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::table('events', function($table) {
          $table->dropColumn('eticket_layout');
          $table->dropColumn('invoice_layout');
      });
    }
}
