<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ActivityGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('activity_groups')->insert([
            [
                'activity_id' => 1,
                'group_id' => 1,
                'educator_id' => 1,
                'capacity' => 15,
                'available_space' => 15,
            ],
            [
                'activity_id' => 1,
                'group_id' => 2,
                'educator_id' => 2,
                'capacity' => 15,
                'available_space' => 15,
            ],
            [
                'activity_id' => 2,
                'group_id' => 3,
                'educator_id' => 3,
                'capacity' => 15,
                'available_space' => 15,
            ],
            
        ]);
    }
}
