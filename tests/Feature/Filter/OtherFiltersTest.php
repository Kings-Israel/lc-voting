<?php

namespace Tests\Feature\Filter;

use App\Http\Livewire\IdeasIndex;
use App\Models\Vote;
use App\Models\User;
use App\Models\Category;
use App\Models\Status;
use App\Models\Idea;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class OtherFiltersTest extends TestCase
{
    use RefreshDatabase;

    public function test_top_voted_filter_works()
    {
        $user = User::factory()->create();
        $userB = User::factory()->create();
        $userC = User::factory()->create();

        $ideaOne = Idea::factory()->create();

        $ideaTwo = Idea::factory()->create();

        Vote::factory()->create([
            'idea_id' => $ideaOne->id,
            'user_id' => $user->id
        ]);

        Vote::factory()->create([
            'idea_id' => $ideaOne->id,
            'user_id' => $userB->id
        ]);

        Vote::factory()->create([
            'idea_id' => $ideaTwo->id,
            'user_id' => $userC->id
        ]);

        Livewire::test(IdeasIndex::class)
            ->set('filter', 'Top Voted')
            ->assertViewHas('ideas', function($ideas) {
                return $ideas->count() === 2 && $ideas->first()->votes()->count() === 2;
            });
    }

    public function test_my_ideas_filter_works_correctly_when_user_logged_in()
    {
        $user = User::factory()->create();
        $userB = User::factory()->create();

        Idea::factory()->create([
            'user_id' => $user->id,
            'title' => 'My First Idea',
        ]);

        Idea::factory()->create([
            'user_id' => $user->id,
            'title' => 'My Second Idea',
        ]);

        Idea::factory()->create([
            'user_id' => $userB->id,
            'title' => 'My Third Idea',
        ]);

        Livewire::actingAs($user)
            ->test(IdeasIndex::class)
            ->set('filter', 'My Ideas')
            ->assertViewHas('ideas', function($ideas) {
                return $ideas->count() === 2 && $ideas->first()->title === 'My Second Idea' && $ideas->get(1)->title === 'My First Idea';
            });
    }

    public function test_my_ideas_filter_works_correctly_when_user_logged_out()
    {
        Idea::factory(3)->create();

        Livewire::
            test(IdeasIndex::class)
            ->set('filter', 'My Ideas')
            ->assertRedirect(route('login'));
    }

    public function test_my_ideas_filter_works_correctly_with_categories_filter()
    {
        $user = User::factory()->create();

        $categoryOne = Category::factory()->create(['name' => 'Category 1']);
        $categoryTwo = Category::factory()->create(['name' => 'Category 2']);

        Idea::factory()->create([
            'user_id' => $user->id,
            'category_id' => $categoryOne->id,
            'title' => 'My First Idea',
        ]);

        Idea::factory()->create([
            'user_id' => $user->id,
            'category_id' => $categoryOne->id,
            'title' => 'My Second Idea',
        ]);

        Idea::factory()->create([
            'user_id' => $user->id,
            'category_id' => $categoryTwo->id,
            'title' => 'My Third Idea',
        ]);

        Livewire::actingAs($user)
            ->test(IdeasIndex::class)
            ->set('filter', 'My Ideas')
            ->set('category', 'Category 1')
            ->assertViewHas('ideas', function($ideas) {
                return $ideas->count() === 2 && $ideas->first()->title === 'My Second Idea' && $ideas->get(1)->title === 'My First Idea';
            });
    }

    public function test_spam_filter_works()
    {
        $user = User::factory()->create();

        Idea::factory()->create([
            'title' => 'My First Idea',
            'spam_reports' => 1,
        ]);

        Idea::factory()->create([
            'title' => 'My Second Idea',
            'spam_reports' => 2,
        ]);

        Idea::factory()->create([
            'title' => 'My Third Idea',
            'spam_reports' => 3,
        ]);

        Idea::factory()->create();

        Livewire::actingAs($user)
            ->test(IdeasIndex::class)
            ->set('filter', 'Spam Ideas')
            ->assertViewHas('ideas', function($ideas) {
                return $ideas->count() === 3
                    && $ideas->first()->title = 'My Third Idea'
                    && $ideas->get(1)->title = 'My Second Idea'
                    && $ideas->get(2)->title = 'My Third Idea';
            });

    }
}