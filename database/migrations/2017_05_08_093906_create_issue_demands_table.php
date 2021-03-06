<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIssueDemandsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('issue_demands', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id')->comment('发布人id');
            $table->unsignedInteger('company_id')->comment('公司id');
            $table->string('province_code', 6)->comment('发布公司所在地区');
            $table->string('contact', 20)->comment('联系人');
            $table->unsignedInteger('tel_type_id')->comment('联系方式类型1.QQ2.微信等');
            $table->string('telephone', 20)->comment('联系方式');
            $table->unsignedInteger('area_id')->comment('代理区域id1.国内2.海外等');
            $table->string('game_type_id')->comment('游戏分类id1.RPG角色扮演游戏2.ARPG动作角色扮演类游戏等，逗号连接');
            $table->unsignedInteger('cooperation_id')->comment('合作方式id1.独带2.联合发行等');
            $table->string('platform_id')->comment('平台id1.安卓2.IOS等，逗号连接');
            $table->unsignedInteger('type_id')->comment('区分id1.网游2.单机等');
            $table->text('description')->comment('需求介绍');
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
        Schema::dropIfExists('issue_demands');
    }
}
