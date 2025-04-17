<?php

namespace Database\Factories;

use App\Models\products;
use Illuminate\Database\Eloquent\Factories\Factory;

class productsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = products::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->word,
        'category_id' => $this->faker->randomDigitNotNull,
        'brand' => $this->faker->word,
        'model' => $this->faker->word,
        'color' => $this->faker->word,
        'bar_code' => $this->faker->word,
        'reference' => $this->faker->word,
        'units' => $this->faker->randomDigitNotNull,
        'buy_price' => $this->faker->word,
        'sell_price' => $this->faker->word,
        'invoicing' => $this->faker->randomDigitNotNull,
        'state' => $this->faker->randomDigitNotNull,
        'storage' => $this->faker->randomDigitNotNull,
        'warranty' => $this->faker->randomDigitNotNull,
        'observations' => $this->faker->word,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
