<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLoginBandsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('login_bands', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id')->comment('绑定用户id');
            $table->string('open_id')->comment('第三方返回id');
            $table->tinyInteger('type')->comment('第三方登陆类型1.QQ2.微信3.微博');
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
        Schema::dropIfExists('login_bands');
    }
}
