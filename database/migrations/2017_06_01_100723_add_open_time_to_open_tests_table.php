<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddOpenTimeToOpenTestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('open_tests', function (Blueprint $table) {
            $table->string('open_time', 20)->after('province_code')->comment('开测时间年月日,格式为0000.00.00');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('open_tests', function (Blueprint $table) {
            //
        });
    }
}
