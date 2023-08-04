<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::factory()->create([
            'email' => 'sam@example.com',
        ]);
        \App\Models\User::factory(9)->create();

        // threads debe ser un método de relación en el modelo Category para que hasThreads() funcione
        \App\Models\Category::factory(10)->hasThreads(20)->create(); // cada categoria tendrá 20 preguntas

        \App\Models\Reply::factory(400)->create();
    }
}
