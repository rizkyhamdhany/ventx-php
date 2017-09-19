<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateBookTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('books', function (Blueprint $table) {
            $table->date('birthday')->after('email');
            $table->text('address')->after('birthday');
            $table->text('city')->after('address');
            $table->string('country', 50)->after('city');
            $table->string('postal_code', 20)->after('country');
            $table->string('payment_method', 50)->after('ticket_class');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('books', function($table) {
            $table->dropColumn('birthday');
            $table->dropColumn('address');
            $table->dropColumn('city');
            $table->dropColumn('country');
            $table->dropColumn('postal_code');
            $table->dropColumn('payment_method');
        });
    }
}
