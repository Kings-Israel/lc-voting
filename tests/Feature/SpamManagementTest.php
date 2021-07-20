<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Http\Livewire\DeleteIdea;
use App\Http\Livewire\IdeaIndex;
use App\Http\Livewire\IdeaShow;
use App\Http\Livewire\MarkIdeaAsSpam;
use Illuminate\Http\Response as HttpResponse;
use Livewire\Livewire;
use App\Models\Idea;
use App\Models\User;
use App\Models\Vote;
use Illuminate\Support\Facades\Response;

class SpamManagementTest extends TestCase
{
    use RefreshDatabase;

    public function test_shows_mark_idea_as_spam_livewire_component_when_user_has_authorization()
    {
        $user = User::factory()->create();
        $idea = Idea::factory()->create();
        $this->actingAs($user)
            ->get(route('idea.show', $idea))
            ->assertSeeLivewire('mark-idea-as-spam');
    }

    public function test_does_not_shows_mark_idea_as_spam_component_when_user_does_not_have_authorization()
    {
        $idea = Idea::factory()->create();
        $this->get(route('idea.show', $idea))
            ->assertDontSeeLivewire('mark-idea-as-spam');
    }

    public function test_marking_an_idea_as_spam_works_when_user_has_authorization()
    {
        $user = User::factory()->create();

        $idea = Idea::factory()->create([
            'user_id' => $user->id,
        ]);

        Livewire::actingAs($user)
            ->test(MarkIdeaAsSpam::class, ['idea' => $idea])
            ->call('markAsSpam')
            ->assertEmitted('ideaMarkedAsSpam');

        $this->assertEquals(1, Idea::first()->spam_reports);
    }

    public function test_mark_an_idea_as_spam_does_work_when_user_does_not_have_authorization()
    {
        $idea = Idea::factory()->create();

        Livewire::test(MarkIdeaAsSpam::class, ['idea' => $idea])
            ->call('markAsSpam')
            ->assertStatus(HttpResponse::HTTP_FORBIDDEN);
    }

    public function test_marking_an_idea_as_spam_does_shows_when_user_has_authorization()
    {
        $user = User::factory()->create();
        $idea = Idea::factory()->create();

        Livewire::actingAs($user)
            ->test(IdeaShow::class, ['idea' => $idea, 'votesCount' => 4])
            ->assertSee('Mark As Spam');
    }

    public function test_marking_an_idea_does_not_show_when_user_has_authorization()
    {
        $idea = Idea::factory()->create();

        Livewire::test(IdeaShow::class, ['idea' => $idea, 'votesCount' => 4])
            ->assertDontSee('Mark As Spam');
    }

    // Marking as NOT Spam Tests
    public function test_shows_mark_idea_as_not_spam_livewire_component_when_user_has_authorization()
    {
        $user = User::factory()->admin()->create();
        $idea = Idea::factory()->create(['spam_reports' => 4]);
        $this->actingAs($user)
            ->get(route('idea.show', $idea))
            ->assertSeeLivewire('mark-idea-as-not-spam');
    }

    public function test_does_not_shows_mark_idea_as_not_spam_component_when_user_does_not_have_authorization()
    {
        $user = User::factory()->create();
        $idea = Idea::factory()->create(['spam_reports' => 4]);
        $this->get(route('idea.show', $idea))
            ->assertDontSeeLivewire('mark-idea-as-not-spam');
    }

    public function test_marking_an_idea_as_not_spam_works_when_user_has_authorization()
    {
        $user = User::factory()->admin()->create();

        $idea = Idea::factory()->create([
            'spam_reports' => 4,
        ]);

        Livewire::actingAs($user)
            ->test(MarkIdeaAsNotSpam::class, ['idea' => $idea])
            ->call('markIdeaNotSpam')
            ->assertEmitted('ideaMarkedAsNotSpam');

        $this->assertEquals(0, Idea::first()->spam_reports);
    }

    public function test_mark_an_idea_as_not_spam_does_work_when_user_does_not_have_authorization()
    {
        $idea = Idea::factory()->create();

        Livewire::test(MarkIdeaAsSpam::class, ['idea' => $idea])
            ->call('markAsSpam')
            ->assertStatus(HttpResponse::HTTP_FORBIDDEN);
    }

    public function test_marking_an_idea_as_not_spam_does_shows_when_user_has_authorization()
    {
        $user = User::factory()->admin()->create();
        $idea = Idea::factory()->create(['spam_reports' => 4]);

        Livewire::actingAs($user)
            ->test(IdeaShow::class, ['idea' => $idea, 'votesCount' => 4])
            ->assertSee('Mark As NOT Spam');
    }

    public function test_marking_an_idea_as_not_spam_does_not_show_when_user_has_authorization()
    {
        $idea = Idea::factory()->create(['spam_reports' => 4]);

        Livewire::test(IdeaShow::class, ['idea' => $idea, 'votesCount' => 4])
            ->assertDontSee('Mark As NOT Spam');
    }

    public function spam_reports_count_shows_on_idea_index_when_user_logged_in_as_admin()
    {
        $user = User::factory()->admin()->create();

        $idea = Idea::factory()->create(['spam_reports' => 4]);

        Livewire::test(IdeaIndex::class, ['idea' => $idea, 'votesCount' => 4])
            ->assertSee('Spam Reports: 3');
    }

    public function spam_reports_count_shows_on_idea_show_when_user_logged_in_as_admin()
    {
        $user = User::factory()->admin()->create();

        $idea = Idea::factory()->create(['spam_reports' => 4]);

        Livewire::test(IdeaShow::class, ['idea' => $idea, 'votesCount' => 4])
            ->assertSee('Spam Reports: 3');
    }
}
