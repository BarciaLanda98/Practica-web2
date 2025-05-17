<?php

namespace Database\Factories;
use App\Models\paralelo;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\paralelo>
 */
class paraleloFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = paralelo::class;
    public function definition(): array
    {
        return [
            'nombre' => 'paralelo ' . $this->faker->unique()->numberBetween(1, 99),
            
        ];
    }
}
