<?php

namespace Tests\Feature\Filter;

use App\Http\Livewire\IdeasIndex;
use App\Models\Vote;
use App\Models\User;
use App\Models\Category;
use App\Models\Idea;
use App\Models\Status;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class SearchFilterTest extends TestCase
{
    use RefreshDatabase;

    public function test_searching_works_when_more_than_3_characters()
    {

        Idea::factory()->create([
            'title' => 'My First Idea',
        ]);

        Idea::factory()->create([
            'title' => 'My Second Idea',
        ]);

        Idea::factory()->create([
            'title' => 'My Third Idea',
        ]);

        Livewire::test(IdeasIndex::class)
            ->set('search', 'Second')
            ->assertViewHas('ideas', function($ideas) {
                return $ideas->count() === 1 && $ideas->first()->title === 'My Second Idea';
            });
    }

    public function test_does_not_perform_search_if_less_than_3_characters()
    {

        Idea::factory()->create([
            'title' => 'My First Idea',
            'description' => 'Description for my first idea'
        ]);

        Idea::factory()->create([
            'title' => 'My Second Idea',
        ]);

        Idea::factory()->create([
            'title' => 'My Third Idea',
        ]);

        Livewire::test(IdeasIndex::class)
            ->set('search', 'Se')
            ->assertViewHas('ideas', function($ideas) {
                return $ideas->count() === 3;
            });
    }

    public function test_search_works_correctly_with_category_filters()
    {

        $categoryOne = Category::factory()->create(['name' => 'Category 1']);
        $categoryTwo = Category::factory()->create(['name' => 'Category 2']);

        Idea::factory()->create([
            'category_id' => $categoryOne->id,
            'title' => 'My First Idea',
            'description' => 'Description for my first idea'
        ]);

        Idea::factory()->create([
            'category_id' => $categoryOne->id,
            'title' => 'My Second Idea',
        ]);

        Idea::factory()->create([
            'category_id' => $categoryTwo->id,
            'title' => 'My Third Idea',
        ]);

        Livewire::test(IdeasIndex::class)
            ->set('search', 'Idea')
            ->set('category', 'Category 1')
            ->assertViewHas('ideas', function($ideas) {
                return $ideas->count() === 2;
            });
    }
}
