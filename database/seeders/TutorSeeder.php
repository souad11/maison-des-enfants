<?php

namespace Database\Seeders;

use App\Models\Tutor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TutorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        Tutor::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
        Tutor::create([
            'user_id' => 4, // Utilisez l'ID de l'utilisateur approprié ici
            'address' => 'Rue de la Loi 16',
            'postal_code' => '1000',
            'phone_number' => '0470123456', // Numéro belge
            'emergency_contact' => '0476987654', // Contact d'urgence en Belgique
        ]);

        Tutor::create([
            'user_id' => 5,
            'address' => 'Avenue Louise 120',
            'postal_code' => '1050',
            'phone_number' => '0485123456',
            'emergency_contact' => '0485987654',
        ]);

        // Tutor::create([
        //     'user_id' => 3,
        //     'address' => 'Rue Neuve 58',
        //     'postal_code' => '1000',
        //     'phone_number' => '0479123456',
        //     'emergency_contact' => 'Pierre Leclercq - 0477987654',
        // ]);

        
    }
}
