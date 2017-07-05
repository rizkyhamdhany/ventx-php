<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->string('order_code', 20);
            $table->string('title', 5);
            $table->string('name', 255);
            $table->string('phonenumber', 20);
            $table->string('email', 50);
            $table->string('ticket_period', 20);
            $table->string('ticket_class', 20);
            $table->string('payment_status', 20);
            $table->string('payment_code', 20);
            $table->integer('ticket_ammount');
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
        Schema::dropIfExists('orders');
    }
}
