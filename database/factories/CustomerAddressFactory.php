<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CustomerAddressFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "zipcode"      => '00000000',
            "address"      => $this->faker->streetAddress(),
            "neighborhood" => $this->faker->streetName(),
            "city"         => "Governador Valadares",
            "state"        => "MG",
            "number"       => (string) $this->faker->randomNumber()
        ];
    }
}
