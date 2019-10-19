<?php

use App\Persona;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePersonasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name'); 
            $table->string('lastname');
            $table->unsignedBigInteger('ci');
            $table->string('address');
            $table->string('gender');
            $table->string('phone')->nullable();
            $table->string('celphone')->nullable();
            $table->string('email')->nullable();
            $table->string('civil_status')->nullable();
            $table->string('date_birth')->nullable();
            $table->string('ocupations')->nullable();
            $table->string('professions')->nullable();
            $table->string('desease')->nullable();
            $table->string('celula')->nullable();
            $table->string('member')->default(Persona::PERSONA_NO_MEMBER);
            $table->unsignedInteger('department_id');
            $table->foreign('department_id')->references('id')->on('departments');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('personas');
    }
}
