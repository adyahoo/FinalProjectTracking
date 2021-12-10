<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddVersionDetailRelation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('project_details', function (Blueprint $table) {
            $table->foreign('project_version_id')->references('id')->on('project_versions');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('project_details', function (Blueprint $table) {
            $table->dropForeign(['project_version_id']);
        });
    }
}
