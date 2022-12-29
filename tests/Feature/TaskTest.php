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

use Illuminate\Support\Facades\DB;

class TaskTest extends TestCase
{
    use RefreshDatabase;

    public function testIndex()
    {
        $tasks = Task::factory()->count(10)->create();
        $response = $this->get(route('tasks.index'));
        $response->assertStatus(200);
        $response->assertSeeText($tasks[0]->name);
        $response->assertSeeText($tasks[8]->status->name);
        $response->assertSeeText($tasks[9]->creator->name);
    }

    public function testCreateIfUserIsNotAuthenticated()
    {
        if (!Auth::check()) {
            $response = $this->get(route('tasks.create'));
            $response->assertRedirect('/login');
        }
    }

    public function testCreate()
    {
        $user = User::factory()->create(['id' => 1]);
        $this->actingAs($user);
        $response = $this->get(route('tasks.create'));
        $response->assertStatus(200);
    }

    public function testStoreIsUserIsNotAuthenticated()
    {
//        $user = User::factory()->count(5)->create();
//        $taskStatus = TaskStatus::factory()->count(5)->create();
//        $this->actingAs($user);

        $params = [
            '_token' => csrf_token(),
            'name' => 'fix all errors',
            'status_id' => 3,
            'created_by_id' => 1
        ];

        if (!Auth::check()) {
            $response = $this->post(route('tasks.store'), $params);
            $response->assertRedirect('/login');
        }
    }

    public function testStoreWithValidationErrors()
    {
        TaskStatus::factory()->count(5)->create();
        $users = User::factory()->count(5)->create();
        $this->actingAs($users[1]);

        $params = [
            '_token' => csrf_token(),
            'name' => '',
            'status_id' => 3,
            'created_by_id' => 1
        ];

        $response = $this->post(route('tasks.store'), $params);

        $response->assertStatus(302);
        $response->assertSessionHasErrors();

        $this->assertDatabaseMissing('tasks', $params);
    }

    public function testStore()
    {
        $user = User::factory()->create(['id' => 5]);
        $this->actingAs($user);

        TaskStatus::factory()->count(3)->create();

        $params = [
            '_token' => csrf_token(),
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

    public function testShow()
    {
        $task = Task::factory()->create();
        $response = $this->get(route('tasks.show', $task));
        $response->assertStatus(200);
        $response->assertSeeText($task->name);
        $response->assertSeeText($task->status->name);
    }

    public function testEditIfUserIsNotAuthenticated()
    {
        if (!Auth::check()) {
            $task = Task::factory()->create();
            $response = $this->get(route('tasks.edit', $task));
            $response->assertRedirect('/login');
        }
    }

    public function testEdit()
    {
        TaskStatus::factory()->count(5)->create();
        $task = Task::factory()->create();
        $user = User::factory()->create(['id' => 6]);
        $this->actingAs($user);

        $response = $this->get(route('tasks.edit', $task));

        $response->assertSee('PATCH');
        $response->assertStatus(200);
    }

    public function testUpdateWithValidationErrors()
    {
        TaskStatus::factory()->count(5)->create();
        User::factory()->count(5)->create();
        $user = User::factory()->create(['id' => 6]);
        $this->actingAs($user);
        $task = Task::factory()->create();

        $params = [
            '_token' => csrf_token(),
            'name' => 'changed name for task',
            'created_by_id' => 4
        ];
        $response = $this->patch(route('tasks.update', $task), $params);

        $response->assertSessionHasErrors();
        $response->assertRedirect();
    }

    public function testUpdate()
    {
        TaskStatus::factory()->count(5)->create();
        User::factory()->count(5)->create();
        $user = User::factory()->create(['id' => 6]);
        $this->actingAs($user);
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

    public function testDestroyIfUserIsNotAuthenticated()
    {
        TaskStatus::factory()->count(5)->create();
        User::factory()->count(5)->create();
        $task = Task::factory()->create();

        $response = $this->delete(route('tasks.destroy', $task));
        $response->assertRedirect('login');
    }

    public function testDestroy()
    {
        TaskStatus::factory()->count(5)->create();
        $tasks = User::factory()->count(5)->create();
        $user = User::factory()->create(['id' => 6]);
        $this->actingAs($user);
        $task = $tasks[4];

        $response = $this->delete(route('tasks.destroy', $task));

        $taskExistence = Task::find($task->id);
        $this->assertNull($taskExistence);
    }
}