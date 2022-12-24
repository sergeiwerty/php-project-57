<?php

namespace Tests\Feature;

use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;
use App\Models\TaskStatus;

class TaskTest extends TestCase
{
    use RefreshDatabase;

    public function testIndex()
    {
        $tasks = Task::factory()->count(10)->create();
        $response = $this->get(route('tasks.index'));
        $response->assertStatus(200);
        dump($tasks[0]->name);
        $response->assertSeeText($tasks[0]->name);
        $response->assertSeeText($tasks[4]->description);
        $response->assertSeeText($tasks[8]->status);
        $response->assertSeeText($tasks[9]->creator);
    }

    public function testCreate()
    {
        $user = User::factory()->create(['id' => 1]);
        $this->actingAs($user);
        $response = $this->get(route('task.create'));
        $response->assertStatus(200);
    }
}