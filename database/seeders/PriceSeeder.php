<?php

namespace Database\Seeders;

use App\Models\Price;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PriceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Price::create([
            'type' => 'Hebdomadaire',
            'price' => 25.00,
        ]);

        Price::create([
            'type' => 'Annuel',
            'price' => 60.00,
        ]);

        
    }
}
