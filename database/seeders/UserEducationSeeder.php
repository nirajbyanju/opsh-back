<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserEducationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('user_education')->insert([
            'user_id' => 1,
            'board_name' => 'BoardName',
            'level' => 'Bachelor',
            'faculty' => 'FacultyName',
            'joined_year' => 2010,
            'gpa' => '3.0',
            'attachment' => 'attachment.pdf',
        ]);
    }
}
