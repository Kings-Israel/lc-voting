<?php

namespace App\Http\Livewire;

use App\Models\Idea;
use Livewire\Component;

class MarkIdeaAsNotSpam extends Component
{
    public $idea;

    public function mount(Idea $idea)
    {
        $this->idea = $idea;
    }

    public function markAsNotSpam()
    {
        if (auth()->guest() || ! auth()->user()->isAdmin()) {
            abort(HttpResponse::HTTP_FORBIDDEN);
        }

        $this->idea->spam_reports = 0;
        $this->idea->save();

        $this->emit('ideaMarkedAsNotSpam');
    }

    public function render()
    {
        return view('livewire.mark-idea-as-not-spam');
    }
}
