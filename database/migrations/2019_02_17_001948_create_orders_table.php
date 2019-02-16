<?php
/**
 * 兑换记录
 */
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->string('order_sn')->comment('本地订单号，系统生成');
            $table->unsignedInteger('goods_id')->comment('商品id');
            $table->unsignedInteger('buy_id')->comment('购买人id');
            $table->unsignedInteger('owner_id')->comment('售货人id');
            $table->unsignedInteger('address_id')->comment('送货地址');
            $table->unsignedInteger('courier_id')->nullable()->comment('快递类型 售货人');
            $table->string('courier_sn')->nullable()->comment('快递订单号 售货人');
            $table->unsignedTinyInteger('status')->default(0)->comment('状态0待发货 1已发货 2已完成关闭');
            $table->softDeletes();
            $table->timestamps();
            $table->index('goods_id');
            $table->index('buy_id');
            $table->index('owner_id');
            $table->index('user_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
