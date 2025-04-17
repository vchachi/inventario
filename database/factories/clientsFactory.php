<?php

namespace Database\Factories;

use App\Models\clients;
use Illuminate\Database\Eloquent\Factories\Factory;

class clientsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = clients::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'fullname' => $this->faker->word,
        'phone' => $this->faker->word,
        'NIF' => $this->faker->word,
        'address' => $this->faker->word,
        'localidad' => $this->faker->word,
        'provincia' => $this->faker->word,
        'postal_code' => $this->faker->word,
        'email' => $this->faker->word,
        'observations' => $this->faker->word,
        'updated_at' => $this->faker->date('Y-m-d H:i:s'),
        'created_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
