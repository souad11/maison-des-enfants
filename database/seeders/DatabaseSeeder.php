<?php

namespace Database\Seeders;

use App\Models\Activity;
use App\Models\ActivityGroup;
use App\Models\Opinion;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call([
           
            UserSeeder::class,
            GroupSeeder::class,
            PriceSeeder::class,
            TutorSeeder::class,
            EducatorSeeder::class,
            ActivitySeeder::class,
             ActivityGroupSeeder::class,
            ChildSeeder::class,
            ScheduleSeeder::class,
            EventSeeder::class,
            FeedbackSeeder::class,
            OpinionSeeder::class,
            PartnerSeeder::class,
            RegistrationSeeder::class,
            
        ]);
    }
}
