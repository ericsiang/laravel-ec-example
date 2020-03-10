<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderCartTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_cart', function (Blueprint $table) {
            $table->bigIncrements('cart_id');
            $table->string('session_id');
            $table->unsignedInteger('user_id')->default(0);
            $table->unsignedInteger('p_id')->default(0);
            $table->string('order_id')->nullable()->comment('訂單ID');
            $table->string('p_name');
            $table->Integer('quantity')->default(0);
            $table->Integer('cart_price')->comment('商品計價')->default(0);
            $table->Integer('unit_price')->comment('商品單價')->default(0);
            $table->Integer('status')->default(1);
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
        Schema::dropIfExists('order_cart');
    }
}
