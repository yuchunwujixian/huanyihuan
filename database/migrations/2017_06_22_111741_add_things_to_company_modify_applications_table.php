<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddThingsToCompanyModifyApplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('company_modify_applications', function (Blueprint $table) {
            $table->boolean('status')->default(0)->comment('申请状态0申请中1申请结束');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('company_modify_applications', function (Blueprint $table) {
            //
        });
    }
}
