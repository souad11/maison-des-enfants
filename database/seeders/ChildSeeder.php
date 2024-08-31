<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Child;

class ChildSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
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
            'birthday' => '2020-07-22',
            'gender' => 'male',
        ]);

        Child::create([
            'tutor_id' => 1, 
            'firstname' => 'Claire',
            'lastname' => 'Lemoine',
            'birthday' => '2016-11-09',
            'gender' => 'female',
        ]);

    }
}
