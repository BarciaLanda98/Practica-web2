<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\paralelo;
use App\Models\estudiante;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\paralelo>
 */
class estudianteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = estudiante::class;
    public function definition(): array
    {
        return [
            //
            'nombre' => $this->faker->name(),
            'cedula' => $this->faker->unique()->numerify('########'),
            'correo' => $this->faker->unique()->safeEmail(),
            'paralelo_id'=>paralelo::factory(),
        ];
    }
}
