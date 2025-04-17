<?php

namespace Database\Factories;

use App\Models\companies;
use Illuminate\Database\Eloquent\Factories\Factory;

class companiesFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = companies::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'socialname' => $this->faker->word,
        'CIFNIF' => $this->faker->word,
        'address' => $this->faker->word,
        'localidad' => $this->faker->word,
        'provincia' => $this->faker->word,
        'postal_code' => $this->faker->word,
        'country' => $this->faker->word,
        'phone' => $this->faker->word,
        'website' => $this->faker->word,
        'email' => $this->faker->word,
        'logo' => $this->faker->word,
        'updated_at' => $this->faker->date('Y-m-d H:i:s'),
        'created_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
