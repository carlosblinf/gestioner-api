<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PersonaStructureTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('persona_structure', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('persona_id');
            $table->unsignedInteger('structure_id');
            $table->foreign('persona_id')->references('id')->on('personas');
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
        Schema::dropIfExists('persona_structure');
    }
}
