<?php
/**
 * 商品分类
 */
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGoodsCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('goods_categories', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('parent_id')->default(0)->nullable()->comment('父类id 0为顶级分类');
            $table->integer('lft')->nullable();
            $table->integer('rgt')->nullable();
            $table->integer('depth')->nullable();
            $table->string('title', 20)->comment('名称');
            $table->boolean('status')->default(1)->comment('1显示，0隐藏');
            $table->tinyInteger('sort')->default(1)->comment('排序');
            $table->string('icon')->nullable()->comment('图标');
            $table->timestamps();
            $table->index('parent_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('goods_categories');
    }
}
