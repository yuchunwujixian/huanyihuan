<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id');
            $table->text('content')->comment('社区帖子内容');
            $table->unsignedInteger('user_id')->comment('用户id');
            $table->boolean('status')->default(1)->commnet('状态1可用0禁用');
            $table->unsignedInteger('points')->comment('点赞数');
            $table->unsignedInteger('collects')->comment('收藏数');
            $table->unsignedInteger('comments')->comment('评论数');
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
        Schema::dropIfExists('posts');
    }
}
