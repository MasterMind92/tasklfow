<?php

namespace Database\Factories;

use App\Models\Project;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Project>
 */
class ProjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'owner_id'    => User::factory(),
            'name'        => fake()->unique()->catchPhrase(),
            'description' => fake()->sentence(12),
        ];  
    }

    public function archived(): static
    {
        return $this->state(fn () => ['archived_at' => now()->subWeek()]);
    }
}
