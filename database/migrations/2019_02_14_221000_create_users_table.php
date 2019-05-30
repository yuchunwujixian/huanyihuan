<?php
/**
 * 用户表
 */
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('mobile', 12)->nullable()->comment('手机号');
            $table->string('nickname')->nullable()->comment('昵称');
            $table->string('name')->nullable()->comment('用户姓名');
            $table->string('email')->nullable()->comment('邮箱');
            $table->string('password');
            $table->string('description')->nullable()->comment('个人说明');
            $table->unsignedTinyInteger('level')->default(1)->comment('等级');
            $table->integer('integral')->default(0)->comment('用户积分');
            $table->string('avatar')->nullable()->comment('用户头像地址');
            $table->boolean('status')->default(1)->comment('状态 0禁用 1正常');
            $table->rememberToken();
            $table->timestamps();
            $table->index('mobile');
            $table->index('email');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
