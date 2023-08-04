<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Thread>
 */
class ThreadFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            // category_id será un configuración (hasThreads()) dentro del seeder
            'user_id'   => rand(1, 10), // un usuario aleatorio entre 1 y 10
            'title'     => $this->faker->sentence,
            'body'      => $this->faker->paragraph,
        ];
    }
}
