<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductPersonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_persons', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('product_id')->comment('产品id');
            $table->unsignedInteger('user_id')->comment('添加人id');
            $table->unsignedInteger('company_id')->comment('添加公司id');
            $table->string('name', 20)->comment('联系人');
            $table->string('job', 20)->comment('职务');
            $table->string('area', 20)->comment('负责区域');
            $table->string('charge', 20)->comment('负责事宜');
            $table->unsignedInteger('tel_type')->comment('联系类型id');
            $table->string('tel_phone')->comment('联系方式');
            $table->smallInteger('type')->comment('1研发方0运营方');
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
        Schema::dropIfExists('product_persons');
    }
}
