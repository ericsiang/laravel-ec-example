<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEcpayReturnLogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ecpay_return_log', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('order_no');
            $table->string('RtnCode');
            $table->longText('RtnMsg');
            $table->longText('get_data');
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
        Schema::dropIfExists('ecpay_return_log');
    }
}
