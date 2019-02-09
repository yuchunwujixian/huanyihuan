<?php
//社区帖子中附件表
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostAttachsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_attachs', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('post_id')->comment('帖子id');
            $table->unsignedInteger('user_id')->comment('用户id');
            $table->string('url')->comment('附件地址');
            $table->timestamps();

            $table->index('post_id');
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
        Schema::dropIfExists('post_attachs');
    }
}
