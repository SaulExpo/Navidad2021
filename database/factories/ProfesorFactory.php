<?php

namespace Database\Factories;

use App\Models\Profesor;
use App\Models\Curso;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Image;

class ProfesorFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Profesor::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $asignatura = Array("Desarrollo en entorno servidor", "Desarrollo en entorno cliente", "Diseño de intefaces web", "Despliegues de aplicaciones web", "Empresas");
        $abreviatura = Array("DSW", "DEW", "DOR", "DPL", "EMR");
        $aux = $abreviatura[array_rand($abreviatura)];
        for ($i=0; $i<=4; $i++){
            if ($abreviatura[$i] == $aux){
                $aux2 = $asignatura[$i];
            }
        }

        $foto = Str::random(15) . ".png";
        $img = Image::make("https://thispersondoesnotexist.com/image"); //cargar una imagen de este sitio
        $img->resize(128, null, function ($constraint) {    //redimensionarla manteniendo el ratio (alto/ancho)
            $constraint->aspectRatio();
        });
        $filePath = public_path('/fotos');
        $img->save("$filePath/$foto");

        return [
            'nombre' => $this->faker->firstName(),
            'apellidos' => $this->faker->lastName(),
            'f_nacimiento' => $this->faker->date(),
            'email' => $this->faker->email(),
            'dni' => $this->faker->dni(),
            'telefono' => $this->faker->phoneNumber(),
            'asignatura_nombre' => $aux2,
            'asignatura_abreviatura' => $aux,
            'curso_id' => Curso::inRandomOrder()->first()->id,
            'foto' => $foto,
        ];
    }
}