<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Internship;
use App\Models\Language;
use App\Models\Technology;
use App\Models\YearLevel;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Internship>
 */
class InternshipFactory extends Factory
{
    protected $model = Internship::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->jobTitle(),
            'language_id' => Language::inRandomOrder()->first()->id,
            'salary' => $this->faker->numberBetween(250, 800),
            'description' => $this->faker->text(),
            'category_id' => $this->faker->randomElement([1, 2, 3]),
            'year_level_id' => YearLevel::inRandomOrder()->first()->id,
            'passed' => $this->faker->boolean(20)
        ];
    }

    /**
     * Configure the factory.
     *
     * @return $this
     */
    public function configure()
    {
        return $this->afterCreating(function (Internship $internship) {
            $technologies = Technology::inRandomOrder()->take(2)->pluck('id');
            $internship->technologies()->attach($technologies);
        });
    }
}
