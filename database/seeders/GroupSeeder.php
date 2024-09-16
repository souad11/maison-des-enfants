<?php

namespace Database\Seeders;

use App\Models\Group;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        Group::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
        Group::create([
            'title' => 'Les fruits',
            'min_age' => 4,
            'max_age' => 6,
        ]);

        Group::create([
            'title' => 'Les fleurs',
            'min_age' => 7,
            'max_age' => 9,
        ]);

        Group::create([
            'title' => 'les Arbres',
            'min_age' => 10,
            'max_age' => 12,
        ]);
    }
}
