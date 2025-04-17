<?php

namespace Database\Factories;

use App\Models\parts;
use Illuminate\Database\Eloquent\Factories\Factory;

class partsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = parts::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->word,
        'brand' => $this->faker->word,
        'model' => $this->faker->word,
        'category_id' => $this->faker->randomDigitNotNull,
        'provider' => $this->faker->word,
        'reference' => $this->faker->word,
        'buy_price' => $this->faker->word,
        'sell_price' => $this->faker->word,
        'units' => $this->faker->randomDigitNotNull,
        'state' => $this->faker->randomDigitNotNull,
        'observations' => $this->faker->word,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
