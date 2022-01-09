<?php

namespace Database\Factories;

use App\Models\Centro;
use Illuminate\Database\Eloquent\Factories\Factory;

class CentroFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Centro::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nombre' => $this->faker->Name(),
            'calle' => $this->faker->address(),
            'longitud' => $this->faker->longitude(),
            'latitud' => $this->faker->latitude(),
            'email' => $this->faker->email(),
            'telefono' => $this->faker->phoneNumber(),
            'web' => $this->faker->domainName(),
        ];
    }
}
