<?php

namespace App\Http\Livewire;

use App\Exceptions\DuplicateVoteException;
use App\Exceptions\VoteNotFoundException;
use App\Models\Idea;
use Livewire\Component;

class IdeaShow extends Component
{
    public $idea;
    public $votesCount;
    public $hasVoted;

    protected $listeners = ['statusUpdated', 'ideaUpdated', 'ideaMarkedAsSpam', 'ideaMarkedAsNotSpam', 'commentAdded'];

    public function mount(Idea $idea, $votesCount)
    {
        $this->idea = $idea;
        $this->votesCount = $votesCount;
        $this->hasVoted = $idea->isVotedByUser(auth()->user());
    }

    public function statusUpdated()
    {
        $this->idea->refresh();
    }

    public function ideaUpdated()
    {
        $this->idea->refresh();
    }

    public function ideaMarkedAsSpam()
    {
        $this->idea->refresh();
    }

    public function ideaMarkedAsNotSpam()
    {
        $this->idea->refresh();
    }

    public function commentAdded()
    {
        $this->idea->refresh();
    }

    public function vote()
    {
        if(! auth()->check()){
            return redirect(route('login'));
        }

        if ($this->hasVoted) {
            try {
                $this->idea->removeVote(auth()->user());
            } catch (VoteNotFoundException $e) {
                //throw $th;
            }
            $this->votesCount--;
            $this->hasVoted = false;
        } else {
            try {
                $this->idea->vote(auth()->user());
            } catch (DuplicateVoteException $e) {
                //throw $th;
            }
            $this->votesCount++;
            $this->hasVoted = true;
        }
    }

    public function render()
    {
        return view('livewire.idea-show');
    }
}
