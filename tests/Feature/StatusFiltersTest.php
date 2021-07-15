<?php

namespace Tests\Feature;

use App\Http\Livewire\IdeasIndex;
use App\Http\Livewire\StatusFilters;
use App\Models\User;
use App\Models\Category;
use App\Models\Status;
use App\Models\Idea;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class StatusFiltersTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_index_page_contains_status_filters_livewire_component()
    {
        $user = User::factory()->create();

        $categoryOne = Category::factory()->create(['name' => 'Category 1']);

        $statusOpen = Status::factory()->create(['name' => 'Open', 'classes' => 'bg-gray-200']);

        $idea = Idea::factory()->create([
            'user_id' => $user->id,
            'category_id' => $categoryOne->id,
            'status_id' => $statusOpen->id,
            'title' => 'My First Idea',
            'description' => 'Description for my first idea'
        ]);

        $this->get(route('idea.index'))
            ->assertSeeLivewire('status-filters');
    }

    public function test_show_page_contains_status_filters_livewire_component()
    {
        $user = User::factory()->create();

        $categoryOne = Category::factory()->create(['name' => 'Category 1']);

        $statusOpen = Status::factory()->create(['name' => 'Open', 'classes' => 'bg-gray-200']);

        $idea = Idea::factory()->create([
            'user_id' => $user->id,
            'category_id' => $categoryOne->id,
            'status_id' => $statusOpen->id,
            'title' => 'My First Idea',
            'description' => 'Description for my first idea'
        ]);

        $this->get(route('idea.show', $idea))
            ->assertSeeLivewire('status-filters');
    }

    public function test_shows_correct_status_count()
    {
        $user = User::factory()->create();

        $categoryOne = Category::factory()->create(['name' => 'Category 1']);

        $statusImplemeted = Status::factory()->create(['id' => 4, 'name' => 'Implemented']);

        $idea = Idea::factory()->create([
            'user_id' => $user->id,
            'category_id' => $categoryOne->id,
            'status_id' => $statusImplemeted->id,
            'title' => 'My First Idea',
            'description' => 'Description for my first idea'
        ]);

        $idea = Idea::factory()->create([
            'user_id' => $user->id,
            'category_id' => $categoryOne->id,
            'status_id' => $statusImplemeted->id,
            'title' => 'My First Idea',
            'description' => 'Description for my first idea'
        ]);

        Livewire::test(StatusFilters::class)
            ->assertSee('All Ideas (2)')
            ->assertSee('Implemented (2)');
    }

    public function test_filtering_works_when_query_string_in_place()
    {
        $user = User::factory()->create();

        $categoryOne = Category::factory()->create(['name' => 'Category 1']);

        $statusOpen = Status::factory()->create(['name' => 'Open', 'classes' => 'bg-gray-200']);
        $statusImplemeted = Status::factory()->create(['name' => 'Implemented', 'classes' => 'bg-green text-white']);
        $statusInProgress = Status::factory()->create(['name' => 'In Progress', 'classes' => 'bg-yellow text-white']);
        $statusConsidering = Status::factory()->create(['name' => 'Considering', 'classes' => 'bg-purple text-white']);
        $statusClosed = Status::factory()->create(['name' => 'Closed', 'classes' => 'bg-red text-white']);

        Idea::factory()->create([
            'user_id' => $user->id,
            'category_id' => $categoryOne->id,
            'status_id' => $statusConsidering->id,
            'title' => 'My First Idea',
            'description' => 'Description for my first idea'
        ]);

        Idea::factory()->create([
            'user_id' => $user->id,
            'category_id' => $categoryOne->id,
            'status_id' => $statusConsidering->id,
            'title' => 'My First Idea',
            'description' => 'Description for my first idea'
        ]);

        Idea::factory()->create([
            'user_id' => $user->id,
            'category_id' => $categoryOne->id,
            'status_id' => $statusInProgress->id,
            'title' => 'My First Idea',
            'description' => 'Description for my first idea'
        ]);

        Idea::factory()->create([
            'user_id' => $user->id,
            'category_id' => $categoryOne->id,
            'status_id' => $statusInProgress->id,
            'title' => 'My First Idea',
            'description' => 'Description for my first idea'
        ]);

        Idea::factory()->create([
            'user_id' => $user->id,
            'category_id' => $categoryOne->id,
            'status_id' => $statusInProgress->id,
            'title' => 'My First Idea',
            'description' => 'Description for my first idea'
        ]);

        Livewire::withQueryParams(['status' => 'In Progress'])
            ->test(IdeasIndex::class)
            ->assertViewHas('ideas', function($ideas) {
                return $ideas->count() === 3 && $ideas->first()->status->name === 'In Progress';
            });

        // $response = $this->get(route('idea.index', ['status' => 'In Progress']));
        // $response->assertSuccessful();
        // $response->assertSee('<div class="bg-yellow text-white text-xxs font-bold uppercase leading-none rounded-full text-center w-28 h-7 py-2 px-4">In Progress</div>', false);
        // $response->asserDonttSee('<div class="bg-purple text-white text-xxs font-bold uppercase leading-none rounded-full text-center w-28 h-7 py-2 px-4">Considering</div>', false);
    }

    public function test_show_page_does_not_show_selected_status()
    {
        $user = User::factory()->create();

        $categoryOne = Category::factory()->create(['name' => 'Category 1']);

        $statusImplemeted = Status::factory()->create(['id' => 4, 'name' => 'Implemented']);

        $idea = Idea::factory()->create([
            'user_id' => $user->id,
            'category_id' => $categoryOne->id,
            'status_id' => $statusImplemeted->id,
            'title' => 'My First Idea',
            'description' => 'Description for my first idea'
        ]);

        $this->get(route('idea.show', $idea))
            ->assertDontSee('border-blue text-gray-900');
    }

    public function test_index_page_shows_selected_status()
    {
        $user = User::factory()->create();

        $categoryOne = Category::factory()->create(['name' => 'Category 1']);

        $statusImplemeted = Status::factory()->create(['id' => 4, 'name' => 'Implemented']);

        $idea = Idea::factory()->create([
            'user_id' => $user->id,
            'category_id' => $categoryOne->id,
            'status_id' => $statusImplemeted->id,
            'title' => 'My First Idea',
            'description' => 'Description for my first idea'
        ]);

        $idea = Idea::factory()->create([
            'user_id' => $user->id,
            'category_id' => $categoryOne->id,
            'status_id' => $statusImplemeted->id,
            'title' => 'My First Idea',
            'description' => 'Description for my first idea'
        ]);

        $this->get(route('idea.index'))
            ->assertSee('border-blue text-gray-900');
    }
}
