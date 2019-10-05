<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ActivityStructureTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activity_structure', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('activity_id');
            $table->unsignedInteger('structure_id');
            $table->foreign('activity_id')->references('id')->on('activities');
            $table->foreign('structure_id')->references('id')->on('structures');

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
        Schema::dropIfExists('activity_structure');
    }
}
