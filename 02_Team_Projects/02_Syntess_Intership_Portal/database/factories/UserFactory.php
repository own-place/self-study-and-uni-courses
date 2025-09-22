<?php

namespace Database\Factories;

use App\Models\Hobby;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => Hash::make('qqqqqqqq'), // password
            'role_id' => Role::INTERN,
            'verified' => false,
            'work_email' => null,
            'remember_token' => Str::random(10),
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (User $user) {
            $hobbies = ['Reading', 'Traveling', 'Cooking', 'Sports', 'Music', 'Gardening', 'Photography', 'Drawing', 'Gaming', 'Writing'];
            $randomHobbies = $this->faker->randomElements($hobbies, $this->faker->numberBetween(1, 5));
            foreach ($randomHobbies as $hobbyName) {
                $user->hobbies()->create([
                    'name' => $hobbyName,
                ]);
            }
        });
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return $this
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }

    /**
     * Indicate that the model's role should be admin.
     *
     * @return $this
     */
    public function admin(): static
    {
        return $this->state(fn (array $attributes) => [
            'first_name' => 'Jerry',
            'last_name' => 'Keirsmaeker',
            'email' => "j.keirsmaeker@gmail.com",
            'role_id' => Role::ADMIN,
            'password' => Hash::make('aaaaaaaa')
        ]);
    }

    /**
     * Indicate that the model's role should be mentor.
     *
     * @return $this
     */
    public function mentor(): static
    {
        return $this->state(fn (array $attributes) => [
            'role_id' => Role::MENTOR,
            'password' => Hash::make('mmmmmmmm'),
        ]);
    }

    public function student(): static
    {
        return $this->state(fn (array $attributes) => [
            'role_id' => Role::STUDENT,
            'password' => Hash::make('llllllll')
        ]);
    }

    public function candidate(): static
    {
        return $this->state(fn (array $attributes) => [
            'role_id' => Role::CANDIDATE,
            'password' => Hash::make('pppppppp')
        ]);
    }

    public function hr(): static
    {
        return $this->state(fn (array $attributes) => [
            'first_name' => 'HR',
            'last_name' => 'Official',
            'email' => "hr.official@gmail.com",
            'role_id' => Role::HR,
            'password' => Hash::make('hrhrhrhr')
        ]);
    }

    public function verified(): static
    {
        return $this->state(fn (array $attributes) => [
            'verified' => true,
            'work_email' => strtolower($attributes['first_name'])[0].".".strtolower($attributes['last_name'])."@syntess.nl"
        ]);
    }


}
