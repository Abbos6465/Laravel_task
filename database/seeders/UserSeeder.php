<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
   
    public function run(): void
    {
        User::create([
            'role_id' => 1,
            'name' =>  'Abbos',
            'email' => "abbos@gmail.com",
            'password' => Hash::make("Abbos123"),
        ]);

        User::create([
            'role_id' => 2,
            'name' =>  'John',
            'email' => "john@gmail.com",
            'password' => Hash::make("JohnDoe123"),
        ]);
    }
}
