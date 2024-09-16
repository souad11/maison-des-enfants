<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Child;
use Illuminate\Support\Facades\DB;

class ChildSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        Child::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        Child::create([
            'tutor_id' => 1, 
            'firstname' => 'Alice',
            'lastname' => 'Dupont',
            'birthday' => '2019-03-15',
            'gender' => 'female',
        ]);

        Child::create([
            'tutor_id' => 2, 
            'firstname' => 'Bob',
            'lastname' => 'Martin',
            'birthday' => '2016-07-22',
            'gender' => 'male',
        ]);

        Child::create([
            'tutor_id' => 1, 
            'firstname' => 'Claire',
            'lastname' => 'Dupont',
            'birthday' => '2014-11-09',
            'gender' => 'female',
        ]);

    }
}
