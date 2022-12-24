<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\TaskStatus;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => fake()->word(),
            'description' => fake()->sentence(3),
            'status_id' => function() {
                return self::factoryForModel(TaskStatus::class)->create()->id;
            },
            'created_by_id' => function() {
                return self::factoryForModel(User::class)->create()->id;
            },
            'assigned_to_id' => function() {
                return self::factoryForModel(User::class)->create()->id;
            }
        ];
    }
}
