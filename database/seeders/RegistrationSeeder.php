<?php

namespace Database\Seeders;

use App\Models\Registration;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RegistrationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        Registration::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
        DB::table('registrations')->insert([
            [
                'child_id' => 1, // ID d'un enfant existant
                'activity_group_id' => 1, // ID d'un groupe d'activités existant
                'status' => 'pending', // Statut de l'inscription
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'child_id' => 2,
                'activity_group_id' => 2,
                'status' => 'pending',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'child_id' => 3,
                'activity_group_id' => 3,
                'status' => 'pending',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
