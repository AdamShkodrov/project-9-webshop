<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::find(1);

        $user->roles()->attach(1);
        $user->roles()->attach(2);
        $user->roles()->attach(3);
      
       User::create([
            'name' => 'Test User',
            'email' => 'test1@example.com',
            'password' => Hash::make('password'), 
        ]);

    }
}
