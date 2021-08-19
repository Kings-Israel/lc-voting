<?php

namespace App\Http\Livewire;

use App\Exceptions\DuplicateVoteException;
use App\Exceptions\VoteNotFoundException;
use App\Http\Livewire\Traits\WithAuthRedirects;
use App\Models\Idea;
use Livewire\Component;

class IdeaShow extends Component
{
    use WithAuthRedirects;

    public $idea;
    public $votesCount;
    public $hasVoted;

    protected $listeners = ['statusUpdated', 'statusUpdatedError', 'ideaUpdated', 'ideaMarkedAsSpam', 'ideaMarkedAsNotSpam', 'commentAdded', 'commentDeleted'];

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

    public function statusUpdatedError()
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

    public function commentDeleted()
    {
        $this->idea->refresh();
    }

    public function vote()
    {
        if(auth()->guest()){
            return $this->redirectToLogin();
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
