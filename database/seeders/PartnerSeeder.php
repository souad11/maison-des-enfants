<?php

namespace Database\Seeders;

use App\Models\Partner;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PartnerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        Partner::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
        DB::table('partners')->insert([
            [
                'name' => 'Sport Academy',
                'description' => 'Centre de formation sportive pour enfants et adolescents.',
                'address' => 'Rue des Sports 15, 1000 Bruxelles, Belgique',
                'phone_number' => '+32 2 123 4567',
                'website' => 'https://sportacademy.be',
                'picture' => 'sport_academy.jpg', // Lien vers l'image du partenaire
            ],
            [
                'name' => 'Art Kids',
                'description' => 'Atelier créatif pour enfants, offrant des cours de dessin et peinture.',
                'address' => 'Avenue des Arts 24, 1050 Ixelles, Belgique',
                'phone_number' => '+32 2 987 6543',
                'website' => 'https://artkids.be',
                'picture' => 'art_kids.jpg',
            ],
            [
                'name' => 'TechFuture',
                'description' => 'École de codage et de technologie pour les jeunes.',
                'address' => 'Boulevard du Futur 9, 1200 Woluwe-Saint-Lambert, Belgique',
                'phone_number' => '+32 2 654 3210',
                'website' => 'https://techfuture.be',
                'picture' => 'tech_future.jpg',
            ],
        ]);
    }
}
