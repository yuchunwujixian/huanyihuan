<?php
/**
 * 主题商品
 */
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTopicGoodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('topic_goods', function (Blueprint $table) {
            $table->unsignedInteger('goods_id')->comment('商品id');
            $table->unsignedInteger('topic_id')->comment('主题id');
            $table->unique(['goods_id', 'topic_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('topic_goods');
    }
}
