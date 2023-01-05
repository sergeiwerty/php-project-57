<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;
use App\Models\TaskStatus;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TaskStatusTest extends TestCase
{
    use RefreshDatabase;

    public function testIndex(): void
    {
        $taskStatuses = TaskStatus::factory()->count(10)->create();
        $response = $this->get(route('task_statuses.index'));
        $response->assertStatus(200);
        $response->assertSeeText($taskStatuses[0]->name);
        $response->assertSeeText($taskStatuses[7]->name);
    }

    public function testCreateIfUserIsNotAuthenticated(): void
    {
        if (!Auth::check()) {
            $response = $this->get(route('task_statuses.create'));
            $response->assertRedirect('/login');
        }
    }

    public function testCreate(): void
    {
        $user = User::factory()->create(['id' => 3]);
        $this->actingAs($user);
        $response = $this->get(route('task_statuses.create'));
        $response->assertStatus(200);
    }

    public function testStoreIfUserIsNotAuthenticated(): void
    {
        $params = [
            'name' => 'something name',
        ];

        if (!Auth::check()) {
            $response = $this->post(route('task_statuses.store'), $params);
            $response->assertRedirect('/login');
        }
    }

    public function testStoreWithValidationErrors(): void
    {
        $user = User::factory()->create(['id' => 1]);
        $this->actingAs($user);

        $params = [
            '_token' => csrf_token(),
            'name' => '',
        ];
        $response = $this->post(route('task_statuses.store'), $params);
        $response->assertStatus(302);
        $response->assertSessionHasErrors();

        $this->assertDatabaseMissing('task_statuses', $params);
    }

    public function testStore(): void
    {
        $user = User::factory()->create(['id' => 1]);
        $this->actingAs($user);

        $params = [
            '_token' => csrf_token(),
            'name' => 'pending approval',
        ];
        $response = $this->post(route('task_statuses.store'), $params);

        $response->assertStatus(302);
        $this->assertDatabaseHas('task_statuses', [
            'name' => $params['name']
        ]);
    }

    public function testEditIfUserIsNotAuthenticated(): void
    {
        if (!Auth::check()) {
            $taskStatus = TaskStatus::factory()->create();
            $response = $this->get(route('task_statuses.edit', $taskStatus));
            $response->assertRedirect('/login');
        }
    }

    public function testEdit(): void
    {
        $user = User::factory()->create(['id' => 5]);
        $this->actingAs($user);
        $taskStatus = TaskStatus::factory()->create();

        $response = $this->get(route('task_statuses.edit', $taskStatus));

        $response->assertSee('PATCH');
        $response->assertStatus(200);
    }

    public function testUpdateIfUserIsNotAuthenticated(): void
    {
        $taskStatus = TaskStatus::factory()->create();
        $params = [
            'name' => 'updated name',
        ];
        $response = $this->patch(route('task_statuses.update', $taskStatus), $params);
        $response->assertRedirect('/login');
    }

    public function testUpdateWithValidationErrors(): void
    {
        $user = User::factory()->create(['id' => 5]);
        $this->actingAs($user);
        $taskStatus = TaskStatus::factory()->create();

        $params = [
            '_token' => csrf_token(),
            'name' => '',
        ];
        $response = $this->patch(route('task_statuses.update', $taskStatus), $params);
        $response->assertSessionHasErrors();
    }

    public function testUpdate(): void
    {
        $user = User::factory()->create(['id' => 2]);
        $this->actingAs($user);
        $taskStatus = TaskStatus::factory()->create();

        $params = [
            'name' => 'needed correction',
        ];
        $response = $this->patch(route('task_statuses.update', $taskStatus), $params);
        $response->assertRedirect();
        $response->assertSessionHasNoErrors();
    }

    public function testDestroyIfUserIsNotAuthenticated(): void
    {
        $taskStatus = TaskStatus::factory()->create();

        $response = $this->delete(route('task_statuses.destroy', $taskStatus));
        $response->assertRedirect('/login');
    }

    public function testDestroy(): void
    {
        $user = User::factory()->create(['id' => 7]);
        $this->actingAs($user);
        $taskStatus = TaskStatus::factory()->create();

        $response = $this->delete(route('task_statuses.destroy', $taskStatus));
        $response->assertRedirect();

        $taskStatusTest = TaskStatus::find($taskStatus->id);
        $this->assertNull($taskStatusTest);
    }
}