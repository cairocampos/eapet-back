<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PetFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $name = $this->faker->name();
        return [
            'name'        => $name,
            'name_search' => strtoupper(tirarAcentos($name)),
            'birthday'    => $this->faker->date(),
            'sex'         => $this->faker->randomElement(['M', 'F'])
        ];
    }
}
