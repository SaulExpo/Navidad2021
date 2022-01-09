<?php

namespace Database\Factories;

use App\Models\Examen;
use App\Models\Alumno;
use App\Models\Profesor;
use Illuminate\Database\Eloquent\Factories\Factory;

class ExamenFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Examen::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'fecha' => $this->faker->date(),
            'nota' => $this->faker->numberBetween(0, 10),
            'alumno_id' => Alumno::inRandomOrder()->first()->id,
            'profesor_id' => Profesor::inRandomOrder()->first()->id,
        ];
    }
}
