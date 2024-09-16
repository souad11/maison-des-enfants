<?php

namespace Database\Seeders;

use App\Models\Event;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        Event::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
        DB::table('events')->insert([
            [
                'title' => 'Prochaine inscription pour les vacances de la Toussaint',
                'description' => 'Inscrivez vos enfants pour les activités des vacances de la Toussaint. Les places sont limitées.',
                'event_date' => '2024-10-28', // Date de l'événement
                'photo' => 'vacances_toussaint.jpg',
            ],
            [
                'title' => 'Journée portes ouvertes',
                'description' => 'Découvrez nos installations et rencontrez notre équipe éducative lors de notre journée portes ouvertes.',
                'event_date' => '2024-10-05',
                'photo' => 'journee_portes_ouvertes.jpg',
            ],
            [
                'title' => 'Atelier créatif pour enfants',
                'description' => 'Un atelier spécial pour développer la créativité des enfants à travers des activités artistiques.',
                'event_date' => '2024-11-10',
                'photo' => 'atelier_creatif.jpg',
            ],
        ]);
    }
}
