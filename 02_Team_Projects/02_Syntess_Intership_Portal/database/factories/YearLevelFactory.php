<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\YearLevel;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\YearLevel>
 */
class YearLevelFactory extends Factory
{
    protected $model = YearLevel::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'level' => $this->faker->unique()->randomElement(['Third Year', 'Fourth Year']),
        ];
    }
}
