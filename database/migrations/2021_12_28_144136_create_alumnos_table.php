<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlumnosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alumnos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre',100)->nullable();
            $table->string('apellidos',100)->nullable();
			$table->date('f_nacimiento')->nullable();
			$table->string('email',50)->nullable();
			$table->string('dni',10)->nullable();
            $table->string('foto',50)->nullable();
            // $table->unsignedBigInteger('profesor_id');
            // $table->foreign('profesor_id')->references('id')->on('profesores')->onDelete('cascade');
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
        Schema::dropIfExists('alumnos');
    }
}
