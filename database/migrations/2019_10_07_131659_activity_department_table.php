<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ActivityDepartmentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activity_department', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('department_id');
            $table->unsignedInteger('activity_id');
            $table->foreign('department_id')->references('id')->on('departments');
            $table->foreign('activity_id')->references('id')->on('activities');

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
        Schema::dropIfExists('activity_department');
    }
}
