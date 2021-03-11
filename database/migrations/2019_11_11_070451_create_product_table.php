<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product', function (Blueprint $table) {
            $table->bigIncrements('p_id');
            $table->string('name');
            $table->string('title');
            $table->Integer('menu_id')->default(0)->comment('子類別');
            $table->Integer('sub_id')->default(0)->comment('子類別');
            $table->bigInteger('price')->default(0)->comment('價格');
            $table->bigInteger('stock')->default(0)->comment('庫存');
            $table->mediumText('desc')->nullable()->comment('產品描述');
            $table->mediumText('content')->nullable()->comment('產品內容');
            $table->string('img')->nullable()->defalut(NULL);
            $table->string('upload_img')->nullable()->defalut(NULL);
            $table->Integer('status')->default(1)->comment('1=前台顯示,2=刪除,3=前台隱藏');
            $table->softDeletes()->comment('軟刪除');
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
        Schema::dropIfExists('product');
    }
}
