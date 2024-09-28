<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('category')->insert([
            ['id' => 1, 'name' => 'Engineering/Architecture' , 'status' => '1'],
            ['id' => 2, 'name' => 'Hospitality/Travel/Tourism', 'status' => '1'],
            ['id' => 3, 'name' => 'Accounting/Finance', 'status' => '1'],
            ['id' => 4,  'name' => 'IT/Telecommunications', 'status' => '1'],
            ['id' => 5,  'name' => 'Sales/Marketing/Customer Service', 'status' => '1'],
            ['id' => 6,  'name' => 'Teaching/Education', 'status' => '1'],
            ['id' => 7,  'name' => 'General Management/Administration', 'status' => '1'],
            ['id' => 8,  'name' => 'Medical/Pharmaceutical', 'status' => '1'],
            ['id' => 9,  'name' => 'Technician', 'status' => '1'],
            ['id' => 10,  'name' => 'Government/INGO/NGO', 'status' => '1'],
            ['id' => 11,  'name' => 'Insurance', 'status' => '1'],
            ['id' => 12,  'name' => 'Other', 'status' => '1'],
        ]);
    }
}
