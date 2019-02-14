<?php
/**
 * 商品列表
 */
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGoodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('goods', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id')->comment('用户id，谁发布的');
            $table->unsignedTinyInteger('category_id')->default(0)->comment('所属分类id 都是二级分类，可不填');
            $table->string('title', 200)->comment('商品名称');
            $table->string('img_url')->comment('商品主图片地址');
            $table->text('description')->comment('商品详情 编辑器编辑');
            $table->Integer('view_count')->default(0)->comment('查看数');
            $table->Integer('collect_count')->default(0)->comment('收藏数');
            $table->unsignedTinyInteger('status')->default(0)->comment('状态0禁用1可用2已完成');
            $table->softDeletes();
            $table->timestamps();
            $table->index('user_id');
            $table->index('category_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('goods');
    }
}
