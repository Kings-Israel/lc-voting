<?php

namespace Tests\Feature;

use App\Http\Livewire\IdeaIndex;
use App\Http\Livewire\IdeasIndex;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Idea;
use App\Models\Category;
use App\Models\Status;
use App\Models\User;
use App\Models\Vote;
use Livewire\Livewire;

class VoteIndexPageTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_index_page_contains_idea_index_livewire_component()
    {

        Idea::factory()->create();

        $response = $this->get(route('idea.index'));
        $response->assertSeeLivewire('idea-index');
    }

    public function test_ideas_index_livewire_correctly_recieves_votes_count()
    {
        $user = User::factory()->create();
        $userb = User::factory()->create();

        $idea = Idea::factory()->create();

        Vote::factory()->create([
            'idea_id' => $idea->id,
            'user_id' => $user->id,
        ]);

        Vote::factory()->create([
            'idea_id' => $idea->id,
            'user_id' => $userb->id,
        ]);

        Livewire::test(IdeasIndex::class)
            ->assertViewHas('ideas', function($ideas) {
                return $ideas->first()->votes_count == 2;
            });
    }

    public function test_votes_count_shows_correctly_on_index_page_livewire_component()
    {
        $idea = Idea::factory()->create();

        Livewire::test(IdeaIndex::class, [
            'idea' => $idea,
            'votesCount' => 5
        ])
        ->assertSet('votesCount', 5)
        ->assertSeeHtml('<div class="font-semibold text-2xl ">5</div>')
        ->assertSeeHtml('<div class="text-sm font-bold leading-none ">5</div>');
    }

    public function test_user_who_is_logged_in_shows_voted_for_idea_already_voted_for()
    {
        $user = User::factory()->create();

        $idea = Idea::factory()->create([
            'user_id' => $user->id,
        ]);

        Vote::factory()->create([
            'idea_id' => $idea->id,
            'user_id' => $user->id,
        ]);

        $idea->votes_count = 1;
        $idea->voted_by_user = 1;

        Livewire::actingAs($user)->test(IdeaIndex::class, [
            'idea' => $idea,
            'votesCount' => 5
        ])
        ->assertSet('hasVoted', true)
        ->assertSeeHtml('Voted');
    }

    public function test_user_who_is_not_logged_in_is_redirected_to_login_page_when_trying_to_vote()
    {
        $user = User::factory()->create();

        $idea = Idea::factory()->create([
            'user_id' => $user->id,
        ]);

        Livewire::test(IdeaIndex::class, [
            'idea' => $idea,
            'votesCount' => 5
        ])
        ->call('vote')
        ->assertRedirect(route('login'));
    }

    public function test_user_who_is_logged_in_can_vote_for_idea()
    {
        $user = User::factory()->create();

        $idea = Idea::factory()->create([
            'user_id' => $user->id,
        ]);

        $this->assertDatabaseMissing('votes', [
            'user_id' => $user->id,
            'idea_id' => $idea->id
        ]);

        Livewire::actingAs($user)->test(IdeaIndex::class, [
            'idea' => $idea,
            'votesCount' => 5
        ])
        ->call('vote')
        ->assertSet('votesCount', 6)
        ->assertSet('hasVoted', true)
        ->assertSee('Voted');

        $this->assertDatabaseHas('votes', [
            'user_id' => $user->id,
            'idea_id' => $idea->id
        ]);
    }

    public function test_user_who_is_logged_in_can_remove_vote_for_idea()
    {
        $user = User::factory()->create();

        $idea = Idea::factory()->create([
            'user_id' => $user->id,
        ]);

        Vote::factory()->create([
            'idea_id' => $idea->id,
            'user_id' => $user->id,
        ]);

        $idea->votes_count = 1;
        $idea->voted_by_user = 1;

        Livewire::actingAs($user)->test(IdeaIndex::class, [
            'idea' => $idea,
            'votesCount' => 5
        ])
        ->call('vote')
        ->assertSet('votesCount', 4)
        ->assertSet('hasVoted', false)
        ->assertSee('Vote')
        ->assertDontSee('Voted');
    }
}
