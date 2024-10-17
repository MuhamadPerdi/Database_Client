<?php

namespace Database\Factories;

use App\Models\jenis_options;
use App\Models\status_options;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\StatusOption>
 */
class status_optionsFactory extends Factory
{
    protected $model = status_options::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'status' => $this->faker->unique()->word,
        ];
    }
}
