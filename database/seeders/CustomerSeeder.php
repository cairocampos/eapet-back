<?php

namespace Database\Seeders;

use App\Models\Breed;
use App\Models\Customer;
use App\Models\CustomerAddress;
use App\Models\Pelage;
use App\Models\Specie;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Customer::factory()
            ->hasAddresses(1)
            ->hasContacts(2)
            ->hasPets(2, [
                'specie_id' => Specie::factory(),
                'pelage_id' => Pelage::factory(),
                'breed_id' => Breed::factory()
            ])
            ->create();
    }
}
