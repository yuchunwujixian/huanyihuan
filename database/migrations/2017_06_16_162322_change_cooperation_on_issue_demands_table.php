<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeCooperationOnIssueDemandsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('issue_demands', function (Blueprint $table) {
            $table->string('cooperation_id')->comment('合作方式id1.独带2.联合发行等，逗号连接')->change();
            $table->dropColumn('content');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('issue_demands', function (Blueprint $table) {
            //
        });
    }
}
