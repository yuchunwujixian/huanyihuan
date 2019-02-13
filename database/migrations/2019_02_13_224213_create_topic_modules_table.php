<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTopicModulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('topic_modules', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->comment('主题名称');
            $table->tinyInteger('status')->default(1)->comment('是否显示 0不显示1显示');
            $table->tinyInteger('sort')->comment('排序');
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
        Schema::dropIfExists('topic_modules');
    }
}
