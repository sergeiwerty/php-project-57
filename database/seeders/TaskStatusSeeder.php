<?php

namespace Database\Seeders;

use App\Models\TaskStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class TaskStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
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
