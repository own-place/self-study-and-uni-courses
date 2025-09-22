<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    public function run()
    {
        DB::table('categories')->insert([
            ['id' => 1, 'name' => 'Data Science'],
            ['id' => 2, 'name' => 'Software Engineering'],
            ['id' => 3, 'name' => 'Business IT Consultancy'],
        ]);
    }
}
