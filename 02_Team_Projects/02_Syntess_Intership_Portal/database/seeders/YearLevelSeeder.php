<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\YearLevel;

class YearLevelSeeder extends Seeder
{
    public function run()
    {
        YearLevel::factory()->count(2)->create();
    }
}
