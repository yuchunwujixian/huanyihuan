<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTablesUserIntegralLogs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_integral_logs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->default(0)->comment('用户id');
            $table->smallInteger('type')->default(0)->comment('积分类型，从配置中查看');
            $table->integer('change_value')->comment('变化值');
            $table->integer('change_before')->comment('变化之前');
            $table->string('note')->nullable()->comment('备注');
            $table->timestamp('created_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_integral_logs');
    }
}
