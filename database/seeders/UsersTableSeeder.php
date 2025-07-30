<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User; 
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $users = [
            [
                'name' => 'Demo User 1',
                'email' => 'demo1@example.com',
                'password' => Hash::make('1234'),  
            ],
            [
                'name' => 'Demo User 2',
                'email' => 'demo2@example.com',
                'password' => Hash::make('1234'),   
            ],
            [
                'name' => 'Demo User 3',
                'email' => 'demo3@example.com',
                'password' => Hash::make('1234'),   
            ],
            [
                'name' => 'Demo User 4',
                'email' => 'demo4@example.com',
                'password' => Hash::make('1234'),   
            ],
            [
                'name' => 'Demo User 5',
                'email' => 'demo5@example.com',
                'password' => Hash::make('1234'),   
            ],
        ];

        foreach ($users as $user) {
            User::firstOrCreate(
                ['email' => $user['email']],   
                [
                    'name' => $user['name'],
                    'password' => $user['password'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        }
    }
}
