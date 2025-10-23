<?php

namespace Database\Seeders;

use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        // Get all users to assign tasks to
        $users = User::all();

        if ($users->isEmpty()) {
            // Create a test user if none exist
            $user = User::create([
                'name' => 'Test User',
                'email' => 'test@example.com',
                'password' => bcrypt('password'),
            ]);
            $users = collect([$user]);
        }

        $statuses = ['pending', 'in_progress', 'completed'];
        $priorities = ['low', 'medium', 'high'];

        // Create 20 tasks with fake data
        for ($i = 0; $i < 20; $i++) {
            Task::create([
                'user_id' => $users->random()->id,
                'title' => $faker->sentence(rand(3, 8), false),
                'description' => $faker->paragraph(rand(2, 4)),
                'status' => $faker->randomElement($statuses),
                'priority' => $faker->randomElement($priorities),
                'due_date' => $faker->optional(0.8)->dateTimeBetween('now', '+30 days'),
            ]);
        }
    }
}
