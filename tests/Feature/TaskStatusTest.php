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

    public function setUp(): void
    {
        parent::setUp();
//
//        $createdAt = Carbon::now();
//        $this->urlDataSet = [
//            'name' =>  'http://example.com/',
//            'created_at' => $createdAt,
//        ];
//
//        $this->id = DB::table('urls')
//            ->insertGetId($this->urlDataSet);
    }

    public function testIndex()
    {
        $taskStatuses = TaskStatus::factory()->count(10)->create();
        $response = $this->get(route('task_statuses.index'));
        $response->assertStatus(200);
        $response->assertSeeText($taskStatuses[0]->name);
        $response->assertSeeText($taskStatuses[7]->name);
    }

//    public function testShow()
//    {
//        $taskStatus = TaskStatus::factory()->create();
//        $response = $this->get(route('task_statuses.create', $taskStatus->id));
//        $response->assertStatus(200);
//        $response->assertSeeText($taskStatus->name);
//        $response->assertSee('<tr>', false);
//    }

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
    public function testEdit()
    {
        $taskStatus = TaskStatus::factory()->create();
        $response = $this->get(route('task_statuses.edit', $taskStatus));
        $response->assertSee('PATCH');
        $response->assertStatus(200);
    }

    public function testUpdateWithValidationErrors()
    {
        $taskStatus = TaskStatus::factory()->create();
        $params = [
            '_token' => csrf_token(),
            'name' => '',
        ];
        $response = $this->patch(route('task_statuses.store'), $params);
        $response->assertSessionHasErrors();
    }

    public function testStoreWithValidationErrors()
    {
        $taskStatus = TaskStatus::factory()->create();
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
        $taskStatus = TaskStatus::factory()->create();
        $params = [
            'name' => 'pending approval',
        ];
        $response = $this->post(route('task_statuses.store'));
    }

}