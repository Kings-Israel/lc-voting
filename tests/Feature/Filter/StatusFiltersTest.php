<?php

namespace Tests\Feature\Filter;

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
        Idea::factory()->create();

        $this->get(route('idea.index'))
            ->assertSeeLivewire('status-filters');
    }

    public function test_show_page_contains_status_filters_livewire_component()
    {
        $idea = Idea::factory()->create();

        $this->get(route('idea.show', $idea))
            ->assertSeeLivewire('status-filters');
    }

    public function test_shows_correct_status_count()
    {
        $statusImplemeted = Status::factory()->create(['id' => 4, 'name' => 'Implemented']);

        Idea::factory()->create([
            'status_id' => $statusImplemeted->id,
        ]);

        Idea::factory()->create([
            'status_id' => $statusImplemeted->id,
        ]);

        Livewire::test(StatusFilters::class)
            ->assertSee('All Ideas (2)')
            ->assertSee('Implemented (2)');
    }

    public function test_filtering_works_when_query_string_in_place()
    {
        $statusInProgress = Status::factory()->create(['name' => 'In Progress', 'classes' => 'bg-yellow text-white']);
        $statusConsidering = Status::factory()->create(['name' => 'Considering', 'classes' => 'bg-purple text-white']);

        Idea::factory()->create([
            'status_id' => $statusConsidering->id,
        ]);

        Idea::factory()->create([
            'status_id' => $statusConsidering->id,
        ]);

        Idea::factory()->create([
            'status_id' => $statusInProgress->id,
        ]);

        Idea::factory()->create([
            'status_id' => $statusInProgress->id,
        ]);

        Idea::factory()->create([
            'status_id' => $statusInProgress->id,
        ]);

        Livewire::withQueryParams(['status' => 'In Progress'])
            ->test(IdeasIndex::class)
            ->assertViewHas('ideas', function($ideas) {
                return $ideas->count() === 3 && $ideas->first()->status->name === 'In Progress';
            });
    }

    public function test_show_page_does_not_show_selected_status()
    {
        $statusImplemeted = Status::factory()->create(['id' => 4, 'name' => 'Implemented']);

        $idea = Idea::factory()->create([
            'status_id' => $statusImplemeted->id,
        ]);

        $this->get(route('idea.show', $idea))
            ->assertDontSee('border-blue text-gray-900');
    }

    public function test_index_page_shows_selected_status()
    {

        $statusImplemeted = Status::factory()->create(['id' => 4, 'name' => 'Implemented']);

        Idea::factory(2)->create([
            'status_id' => $statusImplemeted->id,
        ]);

        $this->get(route('idea.index'))
            ->assertSee('border-blue text-gray-900');
    }
}
