<?php
/**
 * 收藏表
 */
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGoodsCollectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('goods_collects', function (Blueprint $table) {
            $table->unsignedInteger('goods_id')->comment('商品id');
            $table->unsignedInteger('user_id')->comment('用户id');
            $table->unique(['goods_id', 'user_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('goods_collects');
    }
}
