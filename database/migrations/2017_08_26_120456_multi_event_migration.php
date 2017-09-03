<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MultiEventMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('banks', function (Blueprint $table) {
            $table->string('url_logo')->after('account_number');
        });
        Schema::table('orders', function (Blueprint $table) {
            $table->integer('event_id')->after('id')->unsigned();
        });
        Schema::table('tickets', function (Blueprint $table) {
            $table->integer('event_id')->after('id')->unsigned();
        });
        Schema::table('seats', function (Blueprint $table) {
            $table->integer('event_id')->after('id')->unsigned();
        });
        Schema::table('books', function (Blueprint $table) {
            $table->integer('event_id')->after('id')->unsigned();
        });
        Schema::table('bookseats', function (Blueprint $table) {
            $table->integer('event_id')->after('id')->unsigned();
        });
        Schema::table('booktickets', function (Blueprint $table) {
            $table->integer('event_id')->after('id')->unsigned();
        });
        Schema::table('ticket_classes', function (Blueprint $table) {
            $table->integer('event_id')->after('id')->unsigned();
        });
        Schema::table('transactions', function (Blueprint $table) {
            $table->integer('event_id')->after('id')->unsigned();
        });
        Schema::table('book_confs', function (Blueprint $table) {
            $table->integer('event_id')->after('id')->unsigned();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('banks', function($table) {
            $table->dropColumn('url_logo');
        });
        Schema::table('orders', function($table) {
            $table->dropColumn('event_id');
        });
        Schema::table('tickets', function($table) {
            $table->dropColumn('event_id');
        });
        Schema::table('seats', function($table) {
            $table->dropColumn('event_id');
        });
        Schema::table('books', function($table) {
            $table->dropColumn('event_id');
        });
        Schema::table('bookseats', function($table) {
            $table->dropColumn('event_id');
        });
        Schema::table('booktickets', function($table) {
            $table->dropColumn('event_id');
        });
        Schema::table('ticket_classes', function($table) {
            $table->dropColumn('event_id');
        });
        Schema::table('transactions', function($table) {
            $table->dropColumn('event_id');
        });
        Schema::table('book_confs', function($table) {
            $table->dropColumn('event_id');
        });

    }
}
