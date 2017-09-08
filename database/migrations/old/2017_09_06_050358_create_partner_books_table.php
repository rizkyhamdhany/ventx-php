<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePartnerBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ticket_box_tickets', function (Blueprint $table) {
            $table->dropColumn('ticket_code');
            $table->string('book_code', 20)->after('ticket_class_id');
            $table->string('name', 255)->after('book_code');
            $table->string('phonenumber', 20)->after('name');
            $table->string('email', 50)->after('phonenumber');
            $table->string('status', 20)->after('email');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ticket_box_tickets', function($table) {
            $table->string('ticket_code', 50);
            $table->dropColumn('book_code');
            $table->dropColumn('name');
            $table->dropColumn('phonenumber');
            $table->dropColumn('email');
            $table->dropColumn('status');
        });
    }
}
