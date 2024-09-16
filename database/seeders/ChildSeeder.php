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
        Child::create([
            'tutor_id' => 3, 
            'firstname' => 'David',
            'lastname' => 'Leblanc',
            'birthday' => '2018-05-12',
            'gender' => 'male',
        ]);
        
        Child::create([
            'tutor_id' => 3, 
            'firstname' => 'Emma',
            'lastname' => 'Moreau',
            'birthday' => '2017-08-30',
            'gender' => 'female',
        ]);
        
        Child::create([
            'tutor_id' => 2, 
            'firstname' => 'Lucas',
            'lastname' => 'Martin',
            'birthday' => '2020-02-19',
            'gender' => 'male',
        ]);
        
        Child::create([
            'tutor_id' => 3, 
            'firstname' => 'Sophie',
            'lastname' => 'Leblanc',
            'birthday' => '2015-09-25',
            'gender' => 'female',
        ]);
        

    }
}
