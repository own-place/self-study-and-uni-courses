<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->admin()->verified()->create();
        User::factory()->hr()->verified()->create();
        User::factory()->mentor()->verified()->count(3)->create();
        User::factory()->count(2)->unverified()->create();
        User::factory()->count(3)->verified()->create();
        User::factory()->student()->verified()->count(2)->create();
    }
}
