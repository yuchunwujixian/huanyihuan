<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id')->comment('发布人id');
            $table->unsignedInteger('company_id')->comment('公司id');
            $table->string('logo')->comment('产品logo');
            $table->string('title', 20)->comment('产品名称');
            $table->string('contact', 20)->comment('联系人');
            $table->string('telephone', 20)->comment('联系方式');
            $table->string('province_code', 6)->comment('发布公司所在地区');
            $table->unsignedInteger('cooperation_id')->comment('合作方式id1.独带2.联合发行等');
            $table->unsignedInteger('period_id')->comment('阶段id1.立顶2.DEMO等');
            $table->unsignedInteger('platform_id')->comment('平台id1.安卓2.IOS等');
            $table->unsignedInteger('game_type_id')->comment('游戏分类id1.RPG角色扮演游戏2.ARPG动作角色扮演类游戏等');
            $table->unsignedInteger('type_id')->comment('区分id1.网游2.单机等');
            $table->unsignedInteger('area_id')->comment('代理区域id1.国内2.海外等');
            $table->string('url')->comment('下载链接');
            $table->text('description')->comment('产品介绍');
            $table->text('needs')->comment('需求及合作');
            $table->text('content')->comment('备注');
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
        Schema::dropIfExists('products');
    }
}
