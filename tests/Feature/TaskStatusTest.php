<?php

namespace Tests\Feature;

//use Carbon\Carbon;
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
        $tasks = TaskStatus::factory()->count(10)->create();
        $response = $this->get(route('task_statuses.index'));
        $response->assertStatus(200);
        dump($tasks[7]->name);
        $response->assertSeeText($tasks[0]->name);
        $response->assertSeeText($tasks[7]->name);
    }
}