<?php

namespace Tests\Feature;

use App\Http\Livewire\CreateIdea;
use App\Models\Category;
use App\Models\Status;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class CreateIdeaTest extends TestCase
{
    use RefreshDatabase;

    public function test_create_idea_form_does_not_show_when_logged_out()
    {
        $response = $this->get(route('idea.index'));

        $response->assertSuccessful();
        $response->assertSee('Please login to create an idea');
        $response->assertDontSee('Let Us Know what you would like and we\'ll take a look');
    }

    public function test_create_idea_form_does_show_when_logged_in()
    {
        $response = $this->actingAs(User::factory()->create())->get(route('idea.index'));

        $response->assertSuccessful();
        $response->assertDontSee('Please login to create an idea');
        $response->assertSee('Let Us Know what you would like and we\'ll take a look', false);
    }

    public function test_main_page_contains_create_idea_livewire_component()
    {
        $this->actingAs(User::factory()->create())->get(route('idea.index'))->assertSeeLivewire('create-idea');
    }

    public function test_create_idea_form_validation_works()
    {
        Livewire::actingAs(User::factory()->create())
            ->test(CreateIdea::class)
            ->set('title', '')
            ->set('category', '')
            ->set('description', '')
            ->call('createIdea')
            ->assertHasErrors(['title', 'category', 'description'])
            ->assertSee('The title field is required');
    }

    public function test_creating_an_idea_works_correctly()
    {
        $user = User::factory()->create();

        $categoryOne = Category::factory()->create(['name' => 'Category 1']);
        $categoryTwo = Category::factory()->create(['name' => 'Category 2']);

        $statusOpen = Status::factory()->create(['name' => 'Open', 'classes' => 'bg-gray-200']);

        Livewire::actingAs($user)
            ->test(CreateIdea::class)
            ->set('title', 'My First Idea')
            ->set('description', 'This is a test for my first idea')
            ->set('category', $categoryOne->id)
            ->set('status', $statusOpen->id)
            ->call('createIdea')
            ->assertRedirect('/');

        $response = $this->actingAs($user)->get(route('idea.index'));
        $response->assertSuccessful();
        $response->assertSee('My First Idea');
        $response->assertSee('This is a test for my first idea');

        $this->assertDatabaseHas('ideas', ['title' => 'My First Idea']);
    }

    public function test_creating_two_ideas_with_same_title_still_works_but_have_different_slugs()
    {
        $user = User::factory()->create();

        $categoryOne = Category::factory()->create(['name' => 'Category 1']);
        $categoryTwo = Category::factory()->create(['name' => 'Category 2']);

        $statusOpen = Status::factory()->create(['name' => 'Open', 'classes' => 'bg-gray-200']);

        Livewire::actingAs($user)
            ->test(CreateIdea::class)
            ->set('title', 'My First Idea')
            ->set('description', 'This is a test for my first idea')
            ->set('category', $categoryOne->id)
            ->set('status', $statusOpen->id)
            ->call('createIdea')
            ->assertRedirect('/');

        $this->assertDatabaseHas('ideas', ['title' => 'My First Idea', 'slug' => 'my-first-idea']);

        Livewire::actingAs($user)
            ->test(CreateIdea::class)
            ->set('title', 'My First Idea')
            ->set('description', 'This is a test for my first idea')
            ->set('category', $categoryOne->id)
            ->set('status', $statusOpen->id)
            ->call('createIdea')
            ->assertRedirect('/');

        $this->assertDatabaseHas('ideas', ['title' => 'My First Idea', 'slug' => 'my-first-idea-2']);
    }
}
