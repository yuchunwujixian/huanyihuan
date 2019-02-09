<?php
/**
 * 游戏地区表
 */
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGameAreasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('game_areas', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('game_id')->comment('游戏id');
            $table->string('title', 20)->comment('地区名称');
            $table->string('content')->comment('备注');
            $table->string('type', 20)->comment('合作类型');
            $table->string('needs')->comment('需求');
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
        Schema::dropIfExists('game_areas');
    }
}
