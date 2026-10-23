<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $demo = User::factory()->create([
            'name' => 'Awa Demo',
            'email' => 'demo@taskflow.test',
            'password' => bcrypt('password'),
        ]);

        $collegue = User::factory()->create(['email' => 'collegue@taskflow.test']);

        Project::factory()
            ->count(3)
            ->for($demo, 'owner')
            ->hasAttached($demo, ['role' => 'owner'], 'members')
            ->hasAttached($collegue, ['role' => 'member'], 'members')
            ->has(Task::factory()->count(6), 'tasks')
            ->create();
    }
}
