<?php

namespace Database\Factories;

use App\Models\Curso;
use App\Models\Centro;
use Illuminate\Database\Eloquent\Factories\Factory;

class CursoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Curso::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {   
        $curso = Array("Desarrollo de Aplicaciones Web", "Administración de Distemas Informáticos", "Energías Renovables", "Sistemas Micro. y Redes", "Cocina y Gastronomía", "Laboratorio", "Dietética", "Alojamiento", "Sistemas Electrotéc. y Automatizados");
        $abreviatura = Array("DAW", "ASI", "ERE", "SMR", "COC", "LAB", "DIE", "UALO", "SEA");
        $aux = $abreviatura[array_rand($abreviatura)];
        for ($i=0; $i<=8; $i++){
            if ($abreviatura[$i] == $aux){
                $aux2 = $curso[$i];
            }
        }
        
        return [
            'nombre' => $aux2,
            'abreviatura' => $aux,
            'nivel' => $this->faker->numberBetween(1, 2),
            'año' => $this->faker->year(),
            'centro_id' => Centro::inRandomOrder()->first()->id,
        ];
    }
}
