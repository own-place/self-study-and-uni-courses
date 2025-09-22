<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Internship;
use App\Models\Application;
use Faker\Factory as Faker;

class ApplicationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        $users = User::all();
        $internships = Internship::all();

//        foreach ($users as $user) {
//            foreach ($internships as $internship) {
//                $createdAt = $faker->dateTimeBetween('-1 year', 'now');
//                Application::create([
//                    'cv' => 'path/to/cv.pdf',
//                    'resume' => 'path/to/resume.pdf',
//                    'letter_of_enrollment' => 'path/to/letter.pdf',
//                    'preference' => 'Example Preference',
//                    'graduation' => 3,
//                    'user_id' => $user->id,
//                    'internship_id' => $internship->id,
//                    'created_at' => $createdAt
//                ]);
////                $this->command->info('Seeded application for user ' . $user->id . ' and internship ' . $internship->id);
//            }
//        }
    }
}
