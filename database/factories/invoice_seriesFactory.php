<?php

namespace Database\Factories;

use App\Models\invoice_series;
use Illuminate\Database\Eloquent\Factories\Factory;

class invoice_seriesFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = invoice_series::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nombre' => $this->faker->word,
        'shortname' => $this->faker->word,
        'tax_type' => $this->faker->randomDigitNotNull,
        'default_repairs' => $this->faker->word,
        'default_sells' => $this->faker->word,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
