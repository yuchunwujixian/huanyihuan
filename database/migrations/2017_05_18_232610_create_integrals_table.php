<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIntegralsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('integrals', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id')->comment('发布人id');
            $table->unsignedInteger('company_id')->comment('公司id');
            $table->text('needs')->comment('需求');
            $table->text('feedback')->comment('反馈');
            $table->Integer('status')->default(1)->comment('0已处理1未处理-1已撤销');
            $table->Integer('handle')->default(0)->comment('1已领取0未领取');
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
        Schema::dropIfExists('integrals');
    }
}
