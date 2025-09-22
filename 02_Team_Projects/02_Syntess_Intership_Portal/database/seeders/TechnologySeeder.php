<?php

namespace Database\Seeders;

use App\Models\Technology;
use Illuminate\Database\Seeder;

class TechnologySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $technologies = [
            '.NET 8.0', 'C#', 'Azure', 'Azure SQL Server', 'Azure Storage', 'Angular', 'Typescript', 'SCSS'
        ];

        foreach ($technologies as $tech) {
            Technology::firstOrCreate(['name' => $tech]);
        }
    }
}
