<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Alumno;
use App\Models\Profesor;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Centro::factory(5)->create();
        \App\Models\Curso::factory(15)->create();
        \App\Models\Profesor::factory(30)->create();
        \App\Models\Alumno::factory(70)->create();
        \App\Models\Examen::factory(1000)->create();

        foreach (Alumno::all() as $alumno){
            $profesores = \App\Models\Profesor::inRandomOrder()->take(rand(1,3))->pluck('id');
            $alumno->profesores()->attach($profesores);
        }
    }
}
