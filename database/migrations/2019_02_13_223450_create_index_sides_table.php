<?php
/**
 * 首页幻灯片
 */
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIndexSidesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('index_sides', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->comment('幻灯片标题');
            $table->string('url')->nullable()->comment('跳转地址');
            $table->string('img_url')->comment('图片地址');
            $table->tinyInteger('status')->default(1)->comment('是否显示 0不显示1显示');
            $table->tinyInteger('sort')->comment('排序');
            $table->tinyInteger('type')->default(0)->comment('类型0 首页 1为专题 从配置中取');
            $table->integer('p_id')->default(0)->comment('type为1时，对应模块id');
            $table->timestamps();
            $table->index('type');
            $table->index('p_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('index_sides');
    }
}
