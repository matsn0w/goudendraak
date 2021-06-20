<?php

namespace Database\Seeders;

use App\Models\Allergen;
use Illuminate\Database\Seeder;

class AllergenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Allergen::firstOrCreate(['name' => 'gluten']);
        Allergen::firstOrCreate(['name' => 'lactose']);
        Allergen::firstOrCreate(['name' => 'varkensvlees']);
        Allergen::firstOrCreate(['name' => 'schaaldieren']);
        Allergen::firstOrCreate(['name' => 'eieren']);
        Allergen::firstOrCreate(['name' => 'vis']);
        Allergen::firstOrCreate(['name' => 'soja']);
        Allergen::firstOrCreate(['name' => 'pinda']);
        Allergen::firstOrCreate(['name' => 'noten']);
    }
}
