<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CustomerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->email(),
            'birthday' => $this->faker->date(),
            'gender' => $this->faker->randomElement(['m', 'f']),
            'cpf' => substr(apenasNumeros($this->faker->cpf), 0, 11)
        ];
    }
}
