<?php

namespace Database\Factories;

use App\Models\jenis_options;
use App\Models\status_options;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Client>
 */
class ClientFactory extends Factory
{
    protected $model = \App\Models\Client::class;

    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'tanggal' => $this->faker->date,
            'jenis_id' => jenis_options::factory(),
            'kebutuhan' => $this->faker->text,
            'no_telp' => $this->faker->phoneNumber,
            'alamat' => $this->faker->address,
            'sumber' => $this->faker->word,
            'keterangan' => $this->faker->text,
            'status_id' => status_options::factory(),
        ];
    }
}
