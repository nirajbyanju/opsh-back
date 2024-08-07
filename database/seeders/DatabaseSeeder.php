<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\UserEducation;
use App\Models\UserExperience;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserTypeSeeder::class,    // Seed user types first
            RoleSeeder::class,        // Seed roles
            PermissionSeeder::class,  // Seed permissions
            UsersTableSeeder::class,  // Seed users
            UsersDetailsSeeder::class,// Seed user details
            UserEducation::class,     // Seed user education
            UserExperience::class,    // Seed user experience
            RoleUserSeeder::class,    // Seed role-user pivot table
            PermissionRoleSeeder::class, // Seed 
        ]);
    }
}
