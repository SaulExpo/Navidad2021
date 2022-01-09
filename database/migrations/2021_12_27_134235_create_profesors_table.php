<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfesorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profesores', function (Blueprint $table) {
            $table->id();
            $table->string('nombre',100)->nullable();
            $table->string('apellidos',100)->nullable();
			$table->date('f_nacimiento')->nullable();
			$table->string('email',50)->nullable();
			$table->string('dni',10)->nullable();
            $table->string('telefono',20)->nullable();
            $table->string('asignatura_nombre',100)->nullable();
            $table->string('asignatura_abreviatura',4)->nullable();
            $table->string('foto',50)->nullable();
            $table->unsignedBigInteger('curso_id');
            $table->foreign('curso_id')->references('id')->on('cursos')->onDelete('cascade');
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
        Schema::dropIfExists('profesores');
    }
}
