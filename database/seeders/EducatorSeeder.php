<?php

namespace Database\Seeders;

use App\Models\Educator;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EducatorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        Educator::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
        Educator::create([
            'user_id' => 2, // Utilisez un user_id existant dans la table users
            'description' => 'Enseignant expérimenté en pédagogie alternative.',
            'photo' => 'educator1.jpg', // Assurez-vous que le fichier photo existe
        ]);

        Educator::create([
            'user_id' => 3,
            'description' => 'Spécialiste en éducation des jeunes enfants, passionné par l\'apprentissage actif.',
            'photo' => 'educator2.jpg',
        ]);

        Educator::create([
            'user_id' => 4,
            'description' => 'Formateur en activités sportives, motivé par l\'engagement communautaire.',
            'photo' => 'educator3.jpg',
        ]);

        // Ajouter d'autres entrées si nécessaire
    }
}
