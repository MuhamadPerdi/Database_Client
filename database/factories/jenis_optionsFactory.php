<?php

namespace Database\Factories;

use App\Models\jenis_options;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\JenisOption>
 */
class jenis_optionsFactory extends Factory
{
    protected $model = jenis_options::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'jenis' => $this->faker->unique()->word,
        ];
    }
}
