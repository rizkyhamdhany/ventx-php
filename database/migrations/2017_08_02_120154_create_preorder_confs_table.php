<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePreorderConfsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('preorder_confs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('preorder_id');
            $table->string('order_code', 20);
            $table->integer('bank_id');
            $table->string('account_holder', 50);
            $table->date('transfer_date');
            $table->integer('total');
            $table->string('status', 20);
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
        Schema::dropIfExists('preorder_confs');
    }
}
