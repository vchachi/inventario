<?php

namespace Database\Factories;

use App\Models\repairs;
use Illuminate\Database\Eloquent\Factories\Factory;

class repairsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = repairs::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'client_id' => $this->faker->word,
        'category_id' => $this->faker->randomDigitNotNull,
        'brand' => $this->faker->word,
        'model' => $this->faker->word,
        'imei_serie' => $this->faker->word,
        'repair_cost' => $this->faker->word,
        'concept' => $this->faker->word,
        'observations' => $this->faker->word,
        'status' => $this->faker->randomDigitNotNull,
        'date' => $this->faker->word,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
