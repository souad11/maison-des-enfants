<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Activity;

use Illuminate\Support\Facades\DB;

class ActivitySeeder extends Seeder
{
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        Activity::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
      
        Activity::create([
            'price_id' => 1, 
            'title' => 'Vacances de Noêl S1',
            'type' => 'Hebdomadaire',
            'description' => 'Première semaine de congé pour les vacances de Noêl',
            'start_date' => '2024-12-23',
            'end_date' => '2024-12-27',
        ]);

        Activity::create([
            'price_id' => 1, // Assurez-vous que cet ID existe dans votre table des prix
            'title' => 'Vacances de Noêl S2',
            'type' => 'Hebdomadaire',
            'description' => 'Deuxième semaine de congé pour les vancances de Noêl',
            'start_date' => '2024-12-30',
            'end_date' => '2025-01-03',
        ]);

        Activity::create([
            'price_id' => 2, // Assurez-vous que cet ID existe dans votre table des prix
            'title' => 'Activité du Samedi',
            'type' => 'Annuelle',
            'description' => 'Activité proposée le samedi après-midi',
            'start_date' => '2024-09-07',
            'end_date' => '2025-06-28',
        ]);

        
    }
}
