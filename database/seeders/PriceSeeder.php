<?php

namespace Database\Seeders;

use App\Models\Price;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PriceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        Price::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
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
