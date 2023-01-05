<?php

namespace Tests\Feature;

use App\Models\Label;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class LabelTest extends TestCase
{

    use RefreshDatabase;

    public function testIndex(): void
    {
        $labels = Label::factory()->count(5)->create();
        $response = $this->get(route('labels.index'));
        $response->assertStatus(200);
        $response->assertSeeText($labels[0]->name);
        $response->assertSeeText($labels[4]->name);
    }

    public function testCreateIfUserIsNotAuthenticated(): void
    {
        if (!Auth::check()) {
            $response = $this->get(route('labels.create'));
            $response->assertRedirect('/login');
        }
    }

    public function testCreate(): void
    {
        $user = User::factory()->create(['id' => 3]);
        $this->actingAs($user);
        $response = $this->get(route('labels.create'));
        $response->assertStatus(200);
    }

    public function testStoreIfUserIsNotAuthenticated(): void
    {
        $params = [
            'name' => 'something name',
        ];

        if (!Auth::check()) {
            $response = $this->post(route('labels.store'), $params);
            $response->assertRedirect('/login');
        }
    }

    public function testStoreWithValidationErrors(): void
    {
        $user = User::factory()->create(['id' => 1]);
        $this->actingAs($user);

        $params = [
            'name' => '',
        ];
        $response = $this->post(route('labels.store'), $params);
        $response->assertStatus(302);
        $response->assertSessionHasErrors();

        $this->assertDatabaseMissing('labels', $params);
    }

    public function testStore()
    {
        $user = User::factory()->create(['id' => 1]);
        $this->actingAs($user);

        $params = [
            'name' => 'has error',
        ];
        $response = $this->post(route('labels.store'), $params);

        $response->assertStatus(302);
        $this->assertDatabaseHas('labels', [
            'name' => $params['name']
        ]);
    }

    public function testEditIfUserIsNotAuthenticated(): void
    {
        if (!Auth::check()) {
            $label = Label::factory()->create();
            $response = $this->get(route('labels.edit', $label));
            $response->assertRedirect('/login');
        }
    }

    public function testEdit(): void
    {
        $user = User::factory()->create(['id' => 5]);
        $this->actingAs($user);
        $label = Label::factory()->create();

        $response = $this->get(route('labels.edit', $label));

        $response->assertSee('PATCH');
        $response->assertStatus(200);
    }

    public function testUpdateIfUserIsNotAuthenticated(): void
    {
        $label = Label::factory()->create();
        $params = [
            'name' => 'label name',
        ];
        $response = $this->patch(route('labels.update', $label), $params);
        $response->assertRedirect('/login');
    }

    public function testUpdateWithValidationErrors(): void
    {
        $user = User::factory()->create(['id' => 5]);
        $this->actingAs($user);
        $label = Label::factory()->create();

        $params = [
            'name' => '',
        ];
        $response = $this->patch(route('labels.update', $label), $params);
        $response->assertSessionHasErrors();
    }

    public function testUpdate()
    {
        $user = User::factory()->create(['id' => 5]);
        $this->actingAs($user);
        $label = Label::factory()->create();

        $params = [
            'name' => 'new name for label',
        ];
        $response = $this->patch(route('labels.update', $label), $params);
        $response->assertRedirect();
        $response->assertSessionHasNoErrors();
    }

    public function testDestroyIfUserIsNotAuthenticated(): void
    {
        $label = Label::factory()->create();

        $response = $this->delete(route('labels.destroy', $label));
        $response->assertRedirect('/login');
    }

    public function testDestroy(): void
    {
        $user = User::factory()->create(['id' => 7]);
        $this->actingAs($user);
        $label = Label::factory()->create();

        $response = $this->delete(route('labels.destroy', $label));
        $response->assertRedirect();

        $labelTest = Label::find($label->id);
        $this->assertNull($labelTest);
    }
}
