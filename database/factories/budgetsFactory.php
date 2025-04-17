<?php

namespace Database\Factories;

use App\Models\budgets;
use Illuminate\Database\Eloquent\Factories\Factory;

class budgetsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = budgets::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'number' => $this->faker->word,
        'date' => $this->faker->word,
        'state' => $this->faker->randomDigitNotNull,
        'client_id' => $this->faker->randomDigitNotNull,
        'observations' => $this->faker->word,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
