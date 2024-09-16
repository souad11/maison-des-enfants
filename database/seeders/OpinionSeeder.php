<?php

namespace Database\Seeders;

use App\Models\Opinion;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OpinionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        Opinion::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
        DB::table('opinions')->insert([
            [
                'tutor_id' => 1, // ID d'un tuteur existant
                'texte' => 'Je suis très satisfait des activités proposées par l\'équipe éducative. Mon enfant est épanoui et progresse bien.',
                'is_approved' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'tutor_id' => 2,
                'texte' => 'L\'organisation est excellente, et les éducateurs sont très professionnels. Mon fils adore venir ici.',
                'is_approved' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'tutor_id' => 1,
                'texte' => 'Les activités sont intéressantes, mais je pense qu\'il serait bien d\'ajouter plus d\'activités en plein air.',
                'is_approved' => false, // Opinion non approuvée
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
