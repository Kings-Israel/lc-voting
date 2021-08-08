<?php

namespace App\Http\Livewire;

use App\Jobs\NotifyAllVoters;
use App\Models\Idea;
use App\Models\Comment;
use Illuminate\Http\Response;

use Livewire\Component;

class SetStatus extends Component
{
    public $idea;
    public $status;
    public $notifyAllVoters;
    public $comment;

    public function mount(Idea $idea)
    {
        $this->idea = $idea;
        $this->status = $this->idea->status_id;
    }

    public function setStatus()
    {
        if (!auth()->check() || !auth()->user()->isAdmin()) {
            abort(Response::HTTP_FORBIDDEN);
        }

        $this->idea->status_id = $this->status;
        $this->idea->save();

        $this->emit('statusUpdated');

        if ($this->notifyAllVoters) {
            NotifyAllVoters::dispatch($this->idea);
        }

        Comment::create([
            'user_id' => auth()->user()->id,
            'idea_id' => $this->idea->id,
            'status_id' => $this->status,
            'body' => $this->comment ?? 'No comment was added',
            'is_status_update' => true
        ]);

        $this->reset();
    }

    public function render()
    {
        return view('livewire.set-status');
    }
}
