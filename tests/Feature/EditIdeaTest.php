<?php

namespace Tests\Feature;

use App\Models\Idea;
use App\Models\User;
use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Http\Livewire\CreateIdea;
use App\Http\Livewire\EditIdea;
use App\Http\Livewire\IdeaShow;
use Illuminate\Http\Response as HttpResponse;
use Livewire\Livewire;

class EditIdeaTest extends TestCase
{
    use RefreshDatabase;

    public function test_shows_edit_idea_component_when_user_user_has_authorization()
    {
        $user = User::factory()->create();
        $idea = Idea::factory()->create(['user_id' => $user->id]);
        $this->actingAs($user)
            ->get(route('idea.show', $idea))
            ->assertSeeLivewire(EditIdea::class);
    }

    public function test_does_not_shows_edit_idea_component_when_user_user_does_not_have_authorization()
    {
        $user = User::factory()->create();
        $idea = Idea::factory()->create();
        $this->actingAs($user)
            ->get(route('idea.show', $idea))
            ->assertDontSeeLivewire(EditIdea::class);
    }

    public function test_create_idea_form_validation_works()
    {
        $user = User::factory()->create();
        $idea = Idea::factory()->create(['user_id' => $user->id]);

        Livewire::actingAs($user)
            ->test(EditIdea::class, ['idea' => $idea])
            ->set('title', '')
            ->set('category', '')
            ->set('description', '')
            ->call('updateIdea')
            ->assertHasErrors(['title', 'category', 'description'])
            ->assertSee('The title field is required');
    }

    public function test_editing_an_idea_works_when_user_has_authorization()
    {
        $user = User::factory()->create();

        $categoryOne = Category::factory()->create(['name' => 'Category 1']);
        $categoryTwo = Category::factory()->create(['name' => 'Category 2']);

        $idea = Idea::factory()->create([
            'user_id' => $user->id,
            'category_id' => $categoryOne
        ]);

        Livewire::actingAs($user)
            ->test(EditIdea::class, ['idea' => $idea])
            ->set('title', 'My Edited Idea')
            ->set('category', $categoryTwo->id)
            ->set('description', 'Description for my edited idea')
            ->call('updateIdea')
            ->assertEmitted('ideaUpdated');

        $this->assertDatabaseHas('ideas', [
            'title' => 'My Edited Idea',
            'category_id' => $categoryTwo->id,
            'description' => 'Description for my edited idea'
        ]);
    }

    public function test_editing_an_idea_shows_on_menu_when_user_has_authorization()
    {
        $user = User::factory()->create();

        $idea = Idea::factory()->create([
            'user_id' => $user->id,
        ]);

        Livewire::actingAs($user)
            ->test(IdeaShow::class, ['idea' => $idea, 'votesCount' => 4])
            ->assertSee('Edit Idea');
    }

    public function test_editing_an_idea_does_not_show_on_menu_when_user_does_not_have_authorization()
    {
        $user = User::factory()->create();

        $idea = Idea::factory()->create();

        Livewire::actingAs($user)
            ->test(IdeaShow::class, ['idea' => $idea, 'votesCount' => 4])
            ->assertDontSee('Edit Idea');
    }

    public function test_editing_an_idea_does_not_work_when_user_has_authorization_because_different_user_created_idea()
    {
        $user = User::factory()->create();
        $userB = User::factory()->create();

        $categoryOne = Category::factory()->create(['name' => 'Category 1']);
        $categoryTwo = Category::factory()->create(['name' => 'Category 2']);

        $idea = Idea::factory()->create([
            'user_id' => $user->id,
            'category_id' => $categoryOne
        ]);

        Livewire::actingAs($userB)
            ->test(EditIdea::class, ['idea' => $idea])
            ->set('title', 'My Edited Idea')
            ->set('category', $categoryTwo->id)
            ->set('description', 'Description for my edited idea')
            ->call('updateIdea')
            ->assertStatus(HttpResponse::HTTP_FORBIDDEN);
    }

    public function test_editing_an_idea_does_not_work_when_user_has_authorization_because_idea_was_created_longer_than_an_hour_ago()
    {
        $user = User::factory()->create();
        $userB = User::factory()->create();

        $categoryOne = Category::factory()->create(['name' => 'Category 1']);
        $categoryTwo = Category::factory()->create(['name' => 'Category 2']);

        $idea = Idea::factory()->create([
            'user_id' => $user->id,
            'category_id' => $categoryOne,
            'created_at' => now()->subHours(2)
        ]);

        Livewire::actingAs($user)
            ->test(EditIdea::class, ['idea' => $idea])
            ->set('title', 'My Edited Idea')
            ->set('category', $categoryTwo->id)
            ->set('description', 'Description for my edited idea')
            ->call('updateIdea')
            ->assertStatus(HttpResponse::HTTP_FORBIDDEN);
    }

}
