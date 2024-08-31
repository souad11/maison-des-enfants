<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Activity;

class ActivitySeeder extends Seeder
{
    public function run()
    {
      
        Activity::create([
            'price_id' => 1, 
            'title' => 'Vacances de Noêl S1',
            'description' => 'Première semaine de congé pour les vacances de Noêl',
            'start_date' => '2024-12-23',
            'end_date' => '2024-12-27',
        ]);

        Activity::create([
            'price_id' => 1, // Assurez-vous que cet ID existe dans votre table des prix
            'title' => 'Vacances de Noêl S2',
            'description' => 'Deuxième semaine de congé pour les vancances de Noêl',
            'start_date' => '2024-12-30',
            'end_date' => '2025-01-03',
        ]);

        
    }
}
