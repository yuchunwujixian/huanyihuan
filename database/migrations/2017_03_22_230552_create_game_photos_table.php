<?php
/**
 * 游戏图片表
 */
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGamePhotosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('game_photos', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('game_id')->comment('游戏id');
            $table->string('url')->comment('游戏图片地址');
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
        Schema::dropIfExists('game_photos');
    }
}
