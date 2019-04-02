<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldsToTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('about_us', function (Blueprint $table) {
            $table->longText('policy')->nullable()->comment('注册须知');
            $table->string('logo')->nullable()->comment('网站logo');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('about_us', function (Blueprint $table) {
            //
        });
    }
}
