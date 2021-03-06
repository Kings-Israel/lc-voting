<?php

namespace App\Http\Livewire;

use App\Models\Comment;
use Livewire\Component;

class IdeaComment extends Component
{
    public $comment;
    public $ideaUserId;

    protected $listeners = ['commentUpdated', 'commentMarkedAsSpam', 'commentMarkedAsNotSpam'];

    public function mount(Comment $comment, $ideaUserId)
    {
        $this->comment = $comment;
        $this->ideaUserid = $ideaUserId;
    }

    public function commentUpdated()
    {
        $this->comment->refresh();
    }

    public function commentMarkedAsSpam()
    {
        $this->comment->refresh();
    }

    public function commentMarkedAsNotSpam()
    {
        $this->comment->refresh();
    }

    public function render()
    {
        return view('livewire.idea-comment');
    }
}
