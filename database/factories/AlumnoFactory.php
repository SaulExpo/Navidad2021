<?php

namespace Database\Factories;

use App\Models\Alumno;
use App\Models\Profesor;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Image;

class AlumnoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Alumno::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
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
            'foto' => $foto,
            // 'profesor_id' => Profesor::inRandomOrder()->first()->id,
        ];
    }
}
