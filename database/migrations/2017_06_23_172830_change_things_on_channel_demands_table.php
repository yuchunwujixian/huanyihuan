<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeThingsOnChannelDemandsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('channel_demands', function (Blueprint $table) {
            $table->string('platform_id')->comment('平台id1.安卓渠道2.越狱渠道 等，逗号连接')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('channel_demands', function (Blueprint $table) {
            //
        });
    }
}
