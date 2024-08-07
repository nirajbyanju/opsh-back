<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'userCode' => 'Opsh-2024-1',
            'name_tittle' => 'Mr.',
            'first_name' => 'Niraj',
            'last_name' => 'Byanju',
            'username' => 'nirajbyanju',
            'email' => 'nirajbyanju1234@gmail.com',
            'password' => Hash::make('nirajbyanju'),
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
        ]);

    }
}
