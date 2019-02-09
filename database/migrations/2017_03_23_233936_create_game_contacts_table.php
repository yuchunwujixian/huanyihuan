<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGameContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('game_contacts', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('game_id')->comment('游戏id');
            $table->string('name', 20)->comment('联系人');
            $table->string('job', 20)->comment('职务');
            $table->string('area', 20)->comment('负责区域');
            $table->string('charge', 20)->comment('负责事宜');
            $table->string('tel_phone', 20)->comment('联系方式');
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
        Schema::dropIfExists('game_contacts');
    }
}
