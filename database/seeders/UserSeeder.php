<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        User::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');

                //Define data
                $users = [
                    [
                        'login'=>'bob',
                        'firstname'=>'Bob',
                        'lastname'=>'Sull',
                        'email'=>'bob@sull.com',
                        'password'=>'12345678',
                        'role'=>'admin',
                    ],
                    [
                        'login'=>'anna',
                        'firstname'=>'Anna',
                        'lastname'=>'Lyse',
                        'email'=>'anna.lyse@sull.com',
                        'password'=>'12345678',
                        'role'=>'educator',
                    ],
                    [
                        'login'=>'tamara',
                        'firstname'=>'Tamara',
                        'lastname'=>'Guillaume',
                        'email'=>'tamara@guillaume.com',
                        'password'=>'12345678',
                        'role'=>'educator',
                    ],
                    [
                        'login' => 'jane',
                        'firstname' => 'Jane',
                        'lastname' => 'Smith',
                        'email' => 'jane@smith.com',
                        'password' => '12345678',
                        'role' => 'tutor',
                    ],
                    [
                        'login' => 'john',
                        'firstname' => 'John',
                        'lastname' => 'Doe',
                        'email' => 'john@doe.com',
                        'password' => '12345678',
                        'role' => 'tutor',
                    ],
                    
                ];
                
                foreach($users as &$user) {
                    $user['created_at'] = Carbon::now()->toDateTimeString();    //date('Y-m-d G:i:s');
                    $user['password'] = Hash::make($user['password']);
                }
        
                //Insert data in the table
                DB::table('users')->insert($users);        
            
    }
}
