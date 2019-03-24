<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSmsTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sms', function (Blueprint $table) {
            $table->increments('id');
            $table->string('username')->comment('账号');
            $table->tinyInteger('sms_type')->default(1)->comment('类型1手机号 2邮箱');
            $table->string('code', 6)->nullable()->comment('验证码');
            $table->tinyInteger('type')->default(1)->comment('类型1验证码2成功注册通知3重置密码等');
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
        Schema::dropIfExists('emails');
    }
}
