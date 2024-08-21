<?php

namespace Database\Seeders;

use App\Models\Group;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Group::create([
            'title' => 'Les fruits',
            'min_age' => 4,
            'max_age' => 6,
            'capacity' => 15,
            'available_space' => 15,
        ]);

        Group::create([
            'title' => 'Les fleurs',
            'min_age' => 7,
            'max_age' => 9,
            'capacity' => 15,
            'available_space' => 15,
        ]);

        Group::create([
            'title' => 'les arbres',
            'min_age' => 10,
            'max_age' => 12,
            'capacity' => 15,
            'available_space' => 15,
        ]);
    }
}
