<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Schedule;

class ScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schedule::create([
            'activity_group_id' => 1,
            'monday' => 'Balade à la ferme',
            'tuesday' => 'Piscine de Hall',
            'wednesday' => 'Journée à la Bibliothèque',
            'thursday' => 'Férié !',
            'friday' => 'Journée au parc de Forest',
            'saturday' => '//',
        ]);

        Schedule::create([
            'activity_group_id' => 2,
            'monday' => 'Jump xl',
            'tuesday' => 'Pleine de jeux',
            'wednesday' => 'Salle de gym',
            'thursday' => 'Bricolage et ciné',
            'friday' => 'Dégustation de fruits',
            'saturday' => '//',
        ]);

        
    }
}
