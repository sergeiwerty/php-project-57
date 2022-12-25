<?php

namespace Tests\Feature;

use App\Models\Task;
use App\Models\User;
use App\Models\Label;
use Database\Factories\LabelFactory;
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
        $response = $this->get(route('tasks.create'));
        $response->assertStatus(200);
    }

    public function testStore()
    {
        TaskStatus::factory()->count(3)->create();
        User::factory()->count(3)->create();
        $params = [
            'name' => 'fix all errors',
            'status_id' => 3,
            'created_by_id' => 1
        ];
        $response = $this->post(route('tasks.store'), $params);

        $response->assertStatus(302);
        $this->assertDatabaseHas('tasks', [
           'name' => 'fix all errors'
        ]);
    }

    public function testEdit()
    {
        TaskStatus::factory()->count(5)->create();
        User::factory()->count(10)->create();
        $task = Task::factory()->create();
        $response = $this->get(route('tasks.edit', $task));

        $response->assertSee('PATCH');
        $response->assertStatus(200);
    }

    public function testUpdate()
    {
        TaskStatus::factory()->count(5)->create();
        User::factory()->count(7)->create();
        $task = Task::factory()->create();
        $params = [
            '_token' => csrf_token(),
            'name' => 'changed name for task',
            'status_id' => 5,
            'created_by_id' => 4
        ];
        $response = $this->patch(route('tasks.update', $task), $params);

        $response->assertStatus(302);
        $response->assertSessionHasNoErrors();

        $this->assertDatabaseHas('tasks', [
            'name' => 'changed name for task',
            'status_id' => 5
        ]);
    }
}