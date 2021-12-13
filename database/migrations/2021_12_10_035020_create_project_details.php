<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('project_version_id');
            $table->unsignedBigInteger('module_id');
            $table->enum('status', ['not yet', 'on progress', 'done']);
            $table->string('special_module')->nullable();
            $table->date('start_date');
            $table->date('end_date');
            $table->date('start_date_actual')->nullable();
            $table->date('end_date_actual')->nullable();
            $table->integer('realization')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('project_details');
    }
}
