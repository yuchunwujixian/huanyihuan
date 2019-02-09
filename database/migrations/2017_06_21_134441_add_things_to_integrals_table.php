<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddThingsToIntegralsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('integrals', function (Blueprint $table) {
            $table->text('evaluate')->nullable()->comment('发布者评价反馈信息');
            $table->boolean('view_issue')->default(1)->comment('发布者是否查看反馈的信息0未查看1已查看');
            $table->boolean('view_feedback')->default(1)->comment('回答者是否查看提问题者的评价0未查看1已查看');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('integrals', function (Blueprint $table) {
            //
        });
    }
}
