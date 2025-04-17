<?php

namespace Database\Factories;

use App\Models\warranties;
use Illuminate\Database\Eloquent\Factories\Factory;

class warrantiesFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = warranties::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->word,
        'warraty_for' => $this->faker->randomDigitNotNull,
        'duration' => $this->faker->randomDigitNotNull,
        'conditions' => $this->faker->randomDigitNotNull,
        'url_conditions' => $this->faker->word,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
