<?php

namespace Tests\Feature;

//use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;
use App\Models\TaskStatus;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TaskStatusTest extends TestCase
{
    use RefreshDatabase;

//    public function setUp(): void
//    {
//        parent::setUp();
//    }

    public function testIndex()
    {
        $taskStatuses = TaskStatus::factory()->count(10)->create();
        $response = $this->get(route('task_statuses.index'));
        $response->assertStatus(200);
        $response->assertSeeText($taskStatuses[0]->name);
        $response->assertSeeText($taskStatuses[7]->name);
    }

    public function testCreateIfUserIsNotAuthenticated()
    {
        if (!Auth::check()) {
            $response = $this->get(route('task_statuses.create'));
            $response->assertRedirect('/login');
        }
    }

    public function testCreate()
    {
        $user = User::factory()->create(['id' => 3]);
        $this->actingAs($user);
        $response = $this->get(route('task_statuses.create'));
        $response->assertStatus(200);
    }

    public function testStoreIfUserIsNotAuthenticated()
    {
        $params = [
            '_token' => csrf_token(),
            'name' => 'something name',
        ];

        if (!Auth::check()) {
            $response = $this->post(route('task_statuses.store'), $params);
            $response->assertRedirect('/login');
        }
    }
    public function testStoreWithValidationErrors()
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

    public function testStore()
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

    public function testEditIfUserIsNotAuthenticated()
    {
        if (!Auth::check()) {
            $taskStatus = TaskStatus::factory()->create();
            $response = $this->get(route('task_statuses.edit', $taskStatus));
            $response->assertRedirect('/login');
        }
    }
    public function testEdit()
    {
        $user = User::factory()->create(['id' => 5]);
        $this->actingAs($user);
        $taskStatus = TaskStatus::factory()->create();

        $response = $this->get(route('task_statuses.edit', $taskStatus));

        $response->assertSee('PATCH');
        $response->assertStatus(200);
    }

    public function testUpdateIfUserIsNotAuthenticated()
    {
        $taskStatus = TaskStatus::factory()->create();
        $params = [
            '_token' => csrf_token(),
            'name' => 'updated name',
        ];
        $response = $this->patch(route('task_statuses.update', $taskStatus), $params);
        $response->assertRedirect('/login');
    }
    public function testUpdateWithValidationErrors()
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

    public function testUpdate()
    {
        $user = User::factory()->create(['id' => 2]);
        $this->actingAs($user);
        $taskStatus = TaskStatus::factory()->create();

        $params = [
            '_token' => csrf_token(),
            'name' => 'needed correction',
        ];
        $response = $this->patch(route('task_statuses.update', $taskStatus), $params);
        $response->assertRedirect();
        $response->assertSessionHasNoErrors();
    }

    public function testDestroyIfUserIsNotAuthenticated()
    {
        $taskStatus = TaskStatus::factory()->create();

        $response = $this->delete(route('task_statuses.destroy', $taskStatus));
        $response->assertRedirect('/login');
    }

    public function testDestroy()
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