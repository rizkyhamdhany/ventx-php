<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateOrderTableForPayment extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->integer('payment_id')->after('ticket_class');
            $table->string('payment_method', 100)->after('payment_id');
            $table->string('user', 100)->after('url_invoice');
        });
        \DB::statement("UPDATE orders SET payment_method = 'MANUAL INPUT'");
        \DB::statement("UPDATE orders SET user = 'arina@smilemotion.org'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders', function($table)
        {
            $table->dropColumn('payment_id');
            $table->dropColumn('payment_method');
            $table->dropColumn('user');
        });
    }
}
