<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserAccountTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_account', function (Blueprint $table) {
            $table->bigIncrements('user_id');
            $table->string('email');
            $table->string('password');
            $table->Integer('status')->default(1);
            $table->string('provider')->nullable();
            $table->string('provider_user_id')->nullable();
            $table->rememberToken(); //資料表一定要包含一個 remember_token 欄位，這是用來儲存「記住我」的 token
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
        Schema::dropIfExists('user_account');
    }
}
