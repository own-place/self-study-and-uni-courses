<?php

namespace Database\Seeders;

use App\Models\Language;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $languages = ['English', 'Dutch', 'Both (English/Dutch)'];

        foreach ($languages as $language) {
            Language::create(['name' => $language]);
        }
    }
}
