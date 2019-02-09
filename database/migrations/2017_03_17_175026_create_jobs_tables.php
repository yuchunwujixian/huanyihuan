<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJobsTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jobs', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id')->comment('用户id，谁发布的');
            $table->unsignedInteger('company_id')->comment('公司id，哪家公司发的');
            $table->unsignedTinyInteger('job_category_id')->comment('所属分类');
            $table->string('title', 200)->comment('职位名称');

            $table->unsignedTinyInteger('salary_start')->comment('薪水范围其起');
            $table->unsignedTinyInteger('salary_end')->comment('薪水范围止');
            $table->unsignedTinyInteger('experience')->comment('经验 1：实习生 2：1-3年 3:3-5年 4:5-7年');
            $table->unsignedTinyInteger('education')->comment('学历');
            $table->unsignedTinyInteger('type')->comment('工作性质 1全职 2兼职 3实习生');

            $table->string('temptation')->comment('职位诱惑对应福利表，以逗号分隔');
            $table->text('work_conntent')->comment('工作内容');
            $table->text('job_requirements')->comment('任职要求');
            $table->string('work_address')->comment('具体工作地址');

            $table->boolean('status')->default(0)->comment('状态1可用0禁用');
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
        Schema::dropIfExists('jobs');
    }
}
