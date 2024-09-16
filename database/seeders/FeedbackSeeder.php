<?php

namespace Database\Seeders;


use App\Models\Feedback;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FeedbackSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        Feedback::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
        DB::table('feedbacks')->insert([
            [
                'child_id' => 1, // ID de l'enfant
                'activity_group_id' => 1, // ID du groupe d'activités
                'content' => 'L\'enfant a montré un grand intérêt pour les activités de groupe. Il participe activement et prend des initiatives.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'child_id' => 2,
                'activity_group_id' => 1,
                'content' => 'Très bon progrès dans les activités créatives. Il a développé de nouvelles compétences artistiques et fait preuve de beaucoup d\'imagination.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'child_id' => 3,
                'activity_group_id' => 2,
                'content' => 'L\'enfant a encore un peu de difficulté à s\'intégrer au groupe, mais fait des efforts. Je recommande un suivi personnalisé pour l\'encourager.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
