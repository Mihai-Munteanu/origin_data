<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CompanyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->unique()->company(),
            'address' => $this->faker->address(),
            'email' => $this->faker->unique()->email(),
            'phone' => $this->faker->phoneNumber(),
            'description' => $this->faker->text(),

        ];
    }
}
