<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddThingToGoodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('goods', function (Blueprint $table) {
            $table->Integer('province_code')->comment('省');
            $table->Integer('city_code')->comment('市');
            $table->Integer('area_code')->comment('区');
            $table->string('province_name', 20)->after('province_code')->comment('省名');
            $table->string('city_name', 20)->after('city_code')->comment('市名');
            $table->string('area_name', 20)->after('area_code')->comment('区名');
            $table->index('province_code');
            $table->index('city_code');
            $table->index('area_code');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('goods', function (Blueprint $table) {
            //
        });
    }
}
