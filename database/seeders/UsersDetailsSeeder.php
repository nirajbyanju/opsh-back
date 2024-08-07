<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\UserDetail;

class UsersDetailsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();

        foreach ($users as $user) {
            UserDetail::create([
                'user_id' => $user->id,
                'date_of_birth' => '1990-01-01',
                'bio' => 'This is a sample bio for ' . $user->username,
                'profile_picture' => 'default.jpg',
                'marital_status' => 'Single',
                'gender' => 'Male',
                'country' => 'Country',
                'state' => 'State',
                'district' => 'District',
                'local_bodies' => 'Local Bodies',
                'street_name' => 'Street Name',
                'postal_code' => '123456',
                'nationality' => 'Nationality',
                'religion' => 'Religion',
                'language' => 'Language',
                'driving_license' => 'Yes',
                'type_of_license' => 'Type',
            ]);
        }
    }
}
