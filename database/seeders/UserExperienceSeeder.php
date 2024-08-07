<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserExperienceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('user_experience')->insert([
            'user_id' => 1,
            'experience_type' => 'Full_Time',
            'name' => 'Opportunities Sharing',
            'position' => 'Developer',
            'skill' => 'php, Javascript',
            'description' => 'Job Description',
            'experience_year' => 5,
            'attachment' => 'path/to/file.pdf',
        ]);
    }
}
