<?php

namespace Tests\Feature;

use App\Http\Livewire\SetStatus;
use App\Jobs\NotifyAllVoters;
use App\Models\Category;
use App\Models\Idea;
use App\Models\Status;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Queue as FacadesQueue;
use Livewire\Livewire;
use Tests\TestCase;

class AdminSetStatusTest extends TestCase
{
    use RefreshDatabase;

    public function test_show_page_contains_set_status_livewire_component_when_user_is_admin()
    {
        $user = User::factory()->create([
            'email' => 'milimokings@gmail.com'
        ]);

        $categoryOne = Category::factory()->create(['name' => 'Category 1']);
        $categoryTwo = Category::factory()->create(['name' => 'Category 2']);

        $statusOpen = Status::factory()->create(['name' => 'Open']);

        $idea = Idea::factory()->create([
            'user_id' => $user->id,
            'category_id' => $categoryOne->id,
            'status_id' => $statusOpen->id,
            'title' => 'My First Idea',
            'description' => 'Description of my first idea',
        ]);

        $this->actingAs($user)
            ->get(route('idea.show', $idea))
            ->assertSeeLivewire('set-status');
    }
    public function test_show_page_does_not_contains_set_status_livewire_component_when_user_is_admin()
    {
        $user = User::factory()->create([
            'email' => 'johndoe@gmail.com'
        ]);

        $categoryOne = Category::factory()->create(['name' => 'Category 1']);
        $categoryTwo = Category::factory()->create(['name' => 'Category 2']);

        $statusOpen = Status::factory()->create(['name' => 'Open']);

        $idea = Idea::factory()->create([
            'user_id' => $user->id,
            'category_id' => $categoryOne->id,
            'status_id' => $statusOpen->id,
            'title' => 'My First Idea',
            'description' => 'Description of my first idea',
        ]);

        $this->actingAs($user)
            ->get(route('idea.show', $idea))
            ->assertDontSeeLivewire('set-status');
    }

    public function test_initial_status_is_set_correctly()
    {
        $user = User::factory()->create([
            'email' => 'milimokings@gmail.com'
        ]);

        $categoryOne = Category::factory()->create(['name' => 'Category 1']);
        $categoryTwo = Category::factory()->create(['name' => 'Category 2']);

        $statusConsidering = Status::factory()->create(['id' => 2, 'name' => 'Considering']);

        $idea = Idea::factory()->create([
            'user_id' => $user->id,
            'category_id' => $categoryOne->id,
            'status_id' => $statusConsidering->id,
            'title' => 'My First Idea',
            'description' => 'Description of my first idea',
        ]);

        Livewire::actingAs($user)
            ->test(SetStatus::class, ['idea' => $idea])
            ->assertSet('status', $statusConsidering->id);
    }

    public function test_can_set_status_correctly()
    {
        $user = User::factory()->create([
            'email' => 'milimokings@gmail.com'
        ]);

        $categoryOne = Category::factory()->create(['name' => 'Category 1']);
        $categoryTwo = Category::factory()->create(['name' => 'Category 2']);

        $statusConsidering = Status::factory()->create(['id' => 2, 'name' => 'Considering']);
        $statusInProgress = Status::factory()->create(['id' => 3, 'name' => 'In Progress']);

        $idea = Idea::factory()->create([
            'user_id' => $user->id,
            'category_id' => $categoryOne->id,
            'status_id' => $statusConsidering->id,
            'title' => 'My First Idea',
            'description' => 'Description of my first idea',
        ]);

        Livewire::actingAs($user)
        ->test(SetStatus::class, ['idea' => $idea])
        ->set('status', $statusInProgress->id)
        ->call('setStatus')
        ->assertEmitted('statusUpdated');

        $this->assertDatabaseHas('ideas', [
            'id' => $idea->id,
            'status_id' => $statusInProgress->id
        ]);
    }

    public function test_can_set_status_correctly_while_notifying_all_voters()
    {
        $user = User::factory()->create([
            'email' => 'milimokings@gmail.com'
        ]);

        $categoryOne = Category::factory()->create(['name' => 'Category 1']);

        $statusConsidering = Status::factory()->create(['id' => 2, 'name' => 'Considering']);
        $statusInProgress = Status::factory()->create(['id' => 3, 'name' => 'In Progress']);

        $idea = Idea::factory()->create([
            'user_id' => $user->id,
            'category_id' => $categoryOne->id,
            'status_id' => $statusConsidering->id,
            'title' => 'My First Idea',
            'description' => 'Description of my first idea',
        ]);

        FacadesQueue::fake();

        FacadesQueue::assertNothingPushed();

        Livewire::actingAs($user)
        ->test(SetStatus::class, ['idea' => $idea])
        ->set('status', $statusInProgress->id)
        ->set('notifyAllVoters', true)
        ->call('setStatus')
        ->assertEmitted('statusUpdated');

        FacadesQueue::assertPushed(NotifyAllVoters::class);
    }

}