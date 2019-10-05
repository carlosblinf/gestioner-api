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
            $table->unsignedInteger('ci');
            $table->string('address');
            $table->string('municipality');
            $table->string('province');
            $table->string('gender');
            $table->string('phone')->nullable();
            $table->string('celphone')->nullable();
            $table->string('email')->nullable();
            $table->string('civil_status');
            $table->string('date_birth');
            $table->string('ocupations')->nullable();
            $table->string('professions')->nullable();
            $table->string('desease')->nullable();
            $table->string('celula')->nullable();
            $table->string('member')->default(Persona::PERSONA_NO_MEMBER);
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
        Schema::dropIfExists('personas');
    }
}
