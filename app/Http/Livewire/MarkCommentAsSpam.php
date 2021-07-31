<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Http\Response as HttpResponse;
use App\Models\Comment;

class MarkCommentAsSpam extends Component
{
    public Comment $comment;

    protected $listeners = ['setMarkAsSpamComment'];

    public function setMarkAsSpamComment($commentId)
    {
        $this->comment = Comment::findOrFail($commentId);

        $this->emit('markCommentAsSpamSet');
    }

    public function markAsSpam()
    {
        if (auth()->guest()) {
            abort(HttpResponse::HTTP_FORBIDDEN);
        }

        $this->comment->spam_reports++;
        $this->comment->save();

        $this->emit('commentMarkedAsSpam', 'Comment was Marked as spam');
    }

    public function render()
    {
        return view('livewire.mark-comment-as-spam');
    }
}
