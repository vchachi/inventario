<?php

namespace Database\Factories;

use App\Models\tickets;
use Illuminate\Database\Eloquent\Factories\Factory;

class ticketsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = tickets::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'print_method' => $this->faker->randomDigitNotNull,
        'autoprint' => $this->faker->randomDigitNotNull,
        'head' => $this->faker->randomDigitNotNull,
        'barcode' => $this->faker->randomDigitNotNull,
        'paper_size' => $this->faker->word,
        'margin_top' => $this->faker->word,
        'margin_right' => $this->faker->word,
        'margin_bottom' => $this->faker->word,
        'margin_left' => $this->faker->word,
        'ticket_edit' => $this->faker->randomDigitNotNull,
        'hide_address' => $this->faker->word,
        'hide_nifcif' => $this->faker->word,
        'hide_phone' => $this->faker->word,
        'hide_email' => $this->faker->word,
        'hide_website' => $this->faker->word,
        'hide_barcode' => $this->faker->word,
        'updated_at' => $this->faker->date('Y-m-d H:i:s'),
        'created_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
