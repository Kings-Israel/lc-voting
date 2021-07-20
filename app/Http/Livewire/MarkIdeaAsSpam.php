<?php

namespace App\Http\Livewire;

use App\Models\Idea;
use Illuminate\Http\Response as HttpResponse;
use Livewire\Component;

class MarkIdeaAsSpam extends Component
{
    public $idea;

    public function mount(Idea $idea)
    {
        $this->idea = $idea;
    }

    public function markAsSpam()
    {
        if (auth()->guest()) {
            abort(HttpResponse::HTTP_FORBIDDEN);
        }

        $this->idea->spam_reports++;
        $this->idea->save();
        $this->emit('ideaMarkedAsSpam');
    }
    public function render()
    {
        return view('livewire.mark-idea-as-spam');
    }
}
