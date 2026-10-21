<?php

namespace Database\Factories;

use App\Models\Project;
use App\Models\User;
use App\Models\Task;
use App\Enums\TaskStatus;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'project_id' => Project::factory(),
            'title'      => fake()->sentence(4),
            'uuid' => fake()->uuid(),

            'status'     => TaskStatus::Todo,
            'due_at'     => fake()->dateTimeBetween('+1 day', '+2 weeks'),
        ];
    }

    public function overdue(): static
    {
        return $this->state(fn () => ['due_at' => now()->subDays(3)]);
    }

    public function done(): static
    {
        return $this->state(fn () => [
            'status'       => TaskStatus::Done,
            'completed_at' => now()->subDay(),
        ]);
    }
}
