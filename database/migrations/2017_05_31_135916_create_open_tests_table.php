<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOpenTestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('open_tests', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id')->comment('发布人id');
            $table->unsignedInteger('company_id')->comment('公司id');
            $table->string('province_code', 6)->comment('发布公司所在地区');
            $table->unsignedInteger('product_id')->comment('游戏产品id');
            $table->unsignedInteger('schedule_id')->comment('测试进度id1.封测2.内测等');
            $table->boolean('is_del')->default(0)->comment('是否删档1删档0不删档');
            $table->boolean('is_billing')->default(0)->comment('是否计费1.计费0.不计费等');
            $table->string('platform_id')->comment('测试平台id1.安卓2.IOS等逗号连接');
            $table->string('research')->comment('研发方');
            $table->string('issue')->comment('发行方');
            $table->boolean('status')->default(0)->comment('1可用0禁用');
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
        Schema::dropIfExists('open_tests');
    }
}
