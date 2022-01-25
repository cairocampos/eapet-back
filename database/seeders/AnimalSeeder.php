<?php

namespace Database\Seeders;

use App\Models\Breed;
use App\Models\Pelage;
use App\Models\Specie;
use Illuminate\Database\Seeder;

class AnimalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Pelage::create([
            'name' => 'Preto e Branco'
        ]);

        $specie = Specie::create([
            'name' => 'Canino'
        ]);

        Breed::create([
            'name' => 'Pastor Alemão',
            'specie_id' => $specie->id
        ]);
    }
}
