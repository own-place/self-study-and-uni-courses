<?php

namespace Database\Seeders;

use App\Models\Internship;
use App\Models\Category;
use App\Models\Language;
use App\Models\YearLevel;
use App\Models\Technology;
use Illuminate\Database\Seeder;

class InternshipSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Seed the real internships first
        $softwareEngineering = Category::firstOrCreate(['name' => 'Software Engineering']);
        $dataScience = Category::firstOrCreate(['name' => 'Data Science']);
        $businessITConsultant = Category::firstOrCreate(['name' => 'Business IT Consultancy']);

        // Seed the year levels
        $thirdYear = YearLevel::firstOrCreate(['level' => 'Third Year']);
        $fourthYear = YearLevel::firstOrCreate(['level' => 'Fourth Year']);

        // Seed the languages
        $dutch = Language::firstOrCreate(['name' => 'Dutch']);
        $english = Language::firstOrCreate(['name' => 'English']);
        $both = Language::firstOrCreate(['name' => 'Dutch / English']);

        $internships = [
            [
                'title' => 'Graduation internship (Custom research)',
                'description' => 'Would you like to graduate and have control over your research question? Hear from us about what we do and come up with your own assignment with your own interests such as AI, Augmented Reality, machine learning, data analysis and more.',
                'language_id' => $both->id,
                'salary' => 500,
                'category_id' => $softwareEngineering->id,
                'year_level_id' => $fourthYear->id,
                'technologies' => ['Azure', 'C#', '.NET 8.0'],
                'passed' => 0
            ],
            [
                'title' => 'Graduation internship - AI capabilities in our customer portal',
                'description' => 'Our customers can use a portal for their own customers, private and business, to report malfunctions and make appointments, for example. Do some research to discover what AI options are available to improve the user experience of the end customer. Consider, for example, a chatbot linked to our software or automating processes through AI.',
                'language_id' => $dutch->id,
                'salary' => 600,
                'category_id' => $softwareEngineering->id,
                'year_level_id' => $fourthYear->id,
                'technologies' => ['Angular', 'Typescript', 'SCSS'],
                'passed' => 0
            ],
            [
                'title' => 'Graduation internship - Connect to the Power Platform through your own developed API',
                'description' => 'Investigate how you can connect tens of thousands of users to external services such as the Microsoft Power Platform. Consider scalability, security and performance in on-premise and SAAS environments.',
                'language_id' => $both->id,
                'salary' => 550,
                'category_id' => $softwareEngineering->id,
                'year_level_id' => $fourthYear->id,
                'technologies' => ['API', 'Azure', 'Azure SQL Server'],
                'passed' => 0
            ],
            [
                'title' => 'Graduation internship - Use analysis and reporting from the web application',
                'description' => 'Every day, thousands of technicians in the Netherlands are on their way to customers and work with our software. A lot of data is collected but is not fully used for analysis. You can investigate whether a report is possible that shows how much data and resources each user consumes via our web application.',
                'language_id' => $dutch->id,
                'salary' => 520,
                'category_id' => $dataScience->id,
                'year_level_id' => $fourthYear->id,
                'technologies' => ['Data Analysis', 'Reporting'],
                'passed' => 0
            ],
            [
                'title' => 'Internship - Frontend Developer',
                'description' => 'Get started developing our latest generation software product together with our Cloud frontend development team. As an intern, you will work hands-on after onboarding and participate in all sessions with the team, such as standups and refinements.',
                'language_id' => $both->id,
                'salary' => 480,
                'category_id' => $softwareEngineering->id,
                'year_level_id' => $thirdYear->id,
                'technologies' => ['Angular', 'Typescript', 'SCSS', 'Jest'],
                'passed' => 0
            ]
        ];

        foreach ($internships as $internshipData) {
            $internship = Internship::create([
                'title' => $internshipData['title'],
                'description' => $internshipData['description'],
                'language_id' => $internshipData['language_id'],
                'salary' => $internshipData['salary'],
                'category_id' => $internshipData['category_id'],
                'year_level_id' => $internshipData['year_level_id'],
                'passed' => $internshipData['passed']
            ]);

            $technologies = $internshipData['technologies'];
            $technologyIds = [];

            foreach ($technologies as $tech) {
                $technology = Technology::firstOrCreate(['name' => $tech]);
                $technologyIds[] = $technology->id;
            }

            $internship->technologies()->attach($technologyIds);
        }

        // Generate additional fake internships
        Internship::factory()->count(10)->create();
        Internship::factory()->count(10)->create(['passed' => true]);
    }
}
