<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\TaskStatus;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        TaskStatus::factory()
            ->count(4)
            ->state(new Sequence(
                ['name' => 'новый'],
                ['name' => 'в работе'],
                ['name' => 'на тестировании'],
                ['name' => 'завершён'],
            ))
            ->create();
    }
}
