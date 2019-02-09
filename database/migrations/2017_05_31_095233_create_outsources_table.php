<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOutsourcesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('outsources', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id')->comment('发布人id');
            $table->unsignedInteger('company_id')->comment('公司id');
            $table->string('province_code', 6)->comment('发布公司所在地区');
            $table->string('title', 20)->comment('外包名称');
            $table->string('contact', 20)->comment('联系人');
            $table->unsignedInteger('tel_type_id')->comment('联系方式类型1.QQ2.微信等');
            $table->string('telephone', 20)->comment('联系方式');
            $table->unsignedInteger('outsource_id')->comment('外包类别id1.外包需求榜2.外包供应榜等');
            $table->unsignedInteger('precondition_id')->comment('前置条件id1.程序外包2.美术外包等');
            $table->unsignedInteger('cooperation_id')->comment('合作方式id1.独带2.联合发行等');
            $table->string('needs', 20)->comment('要求');
            $table->text('description')->comment('外包介绍');
            $table->text('content')->comment('备注');
            $table->boolean('status')->default(0)->comment('1可用0待审核-1已删除');
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
        Schema::dropIfExists('outsources');
    }
}
