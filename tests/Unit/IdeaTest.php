<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Category;
use App\Models\Idea;
use App\Models\Status;
use App\Models\User;
use App\Models\Vote;

class IdeaTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_can_chack_if_idea_is_voted_by_user()
    {
        $user = User::factory()->create();
        $userB = User::factory()->create();

        $categoryOne = Category::factory()->create([
            'name' => 'Category One'
        ]);

        $statusOpen = Status::factory()->create(['name' => 'Open', 'classes' => 'bg-gray-200']);

        $ideaOne = Idea::factory()->create([
            'user_id' => $user->id,
            'title' => 'My First Idea',
            'category_id' => $categoryOne->id,
            'status_id' => $statusOpen->id,
            'description' =>'Description of my first Idea'
        ]);

        Vote::factory()->create([
            'idea_id' => $ideaOne->id,
            'user_id' => $user->id,
        ]);

        $this->assertTrue($ideaOne->isVotedByUser($user));
        $this->assertFalse($ideaOne->isVotedByUser($userB));
        $this->assertFalse($ideaOne->isVotedByUser(null));
    }

    public function test_user_can_vote_for_an_idea()
    {
        $user = User::factory()->create();
        $userB = User::factory()->create();

        $categoryOne = Category::factory()->create([
            'name' => 'Category One'
        ]);

        $statusOpen = Status::factory()->create(['name' => 'Open', 'classes' => 'bg-gray-200']);

        $idea = Idea::factory()->create([
            'user_id' => $user->id,
            'title' => 'My First Idea',
            'category_id' => $categoryOne->id,
            'status_id' => $statusOpen->id,
            'description' =>'Description of my first Idea'
        ]);

        $this->assertFalse($idea->isVotedByUser($user));
        $idea->vote($user);
        $this->assertTrue($idea->isVotedByUser($user));
    }

    public function test_user_can_remove_vote_for_an_idea()
    {
        $user = User::factory()->create();

        $categoryOne = Category::factory()->create([
            'name' => 'Category One'
        ]);

        $statusOpen = Status::factory()->create(['name' => 'Open', 'classes' => 'bg-gray-200']);

        $idea = Idea::factory()->create([
            'user_id' => $user->id,
            'title' => 'My First Idea',
            'category_id' => $categoryOne->id,
            'status_id' => $statusOpen->id,
            'description' =>'Description of my first Idea'
        ]);

        Vote::factory()->create([
            'idea_id' => $idea->id,
            'user_id' => $user->id
        ]);

        $this->assertTrue($idea->isVotedByUser($user));
        $idea->removeVote($user);
        $this->assertTrue($idea->isVotedByUser($user));
    }
}
