<?php
/**
 * 游戏表
 */
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGamesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('games', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title', 20)->comment('游戏名称');
            $table->string('icon')->comment('游戏图标文字');
            $table->unsignedInteger('company_id')->comment('运营公司');
            $table->string('company')->comment('研发公司');
            $table->unsignedTinyInteger('type_id')->comment('类型');
            $table->string('img')->comment('主头像');
            $table->string('url')->comment('下载地址');
            $table->text('needs')->comment('需求目标');
            $table->text('content')->comment('游戏介绍');
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
        Schema::dropIfExists('games');
    }
}
