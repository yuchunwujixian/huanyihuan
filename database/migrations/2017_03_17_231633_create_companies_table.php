<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id')->comment('用户id,创建者');
            $table->string('title')->comment('公司名称');
            $table->string('logo')->comment('公司logo');
            $table->string('type')->nullable()->comment('公司类型');
            $table->string('province_code', 6)->comment('省');
            $table->string('city_code', 6)->comment('市');
            $table->string('area_code', 6)->comment('区');
            $table->string('address')->nullable()->comment('详细公司地址');
            $table->string('url')->nullable()->comment('公司网址');
            $table->string('position')->nullable()->comment('公司定位（类型）');
            $table->string('telephone', 12)->nullable()->comment('电话');
            $table->string('description')->nullable()->comment('公司介绍');
            $table->string('resume_receive_email')->nullable()->comment('简历接收邮箱');
            $table->unsignedTinyInteger('job_counts')->default(0)->comment('该公司发布多少条职位');
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
        Schema::dropIfExists('companies');
    }
}
