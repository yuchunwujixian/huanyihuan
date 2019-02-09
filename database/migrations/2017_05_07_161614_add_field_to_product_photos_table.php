<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldToProductPhotosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('product_photos', function (Blueprint $table) {
            $table->unsignedInteger('user_id')->after('id')->comment('发布人id');
            $table->unsignedInteger('company_id')->after('product_id')->comment('发布人所在公司id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('product_photos', function (Blueprint $table) {
            //
        });
    }
}
