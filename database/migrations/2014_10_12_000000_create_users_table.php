<?php

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
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('mobile', 12)->comment('手机号');
            $table->unsignedInteger('company_id')->nullable()->comment('公司id');
            $table->string('department')->nullable()->comment('部门');
            $table->string('manage_area')->nullable()->comment('负责区域');
            $table->string('manage_matters')->nullable()->comment('负责事宜');
            $table->string('position')->nullable()->comment('职务');
            $table->string('description')->nullable()->comment('个人说明');
            $table->unsignedInteger('integral')->default(0)->comment('积分');
            $table->string('qq')->nullable()->comment('qq');
            $table->string('weixin')->nullable()->comment('weixin');
            $table->string('telphone')->nullable()->comment('telephone');
            $table->unsignedTinyInteger('level')->default(1)->comment('等级');

            $table->rememberToken();
            $table->timestamps();

            $table->index('company_id');
            $table->index('mobile');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('users');
    }
}
