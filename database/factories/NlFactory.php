<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class NewsletterFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->title(),
            'article' => $this->faker->->sentence($nbWords = 6, $variableNbWords = true),
            'user_id' => $this->faker->randomDigitNotNull(),            //
        ];
    }
}
