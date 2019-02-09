<?php
//福利表
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWelfaresTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('welfares', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title', 50)->comment('福利名称');
            $table->boolean('status')->default(1)->comment('专题：1可用 0禁用');
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
        Schema::dropIfExists('welfares');
    }
}
