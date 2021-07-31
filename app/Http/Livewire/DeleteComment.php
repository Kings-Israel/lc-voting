<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Comment;
use Illuminate\Http\Response as HttpResponse;

class DeleteComment extends Component
{
    public Comment $comment;

    protected $listeners = ['setDeleteComment'];

    public function setDeleteComment($commentId)
    {
        $this->comment = Comment::findOrFail($commentId);

        $this->emit('deleteCommentSet');
    }

    public function deleteComment()
    {
        if (auth()->guest() || auth()->user()->cannot('delete', $this->comment)) {
            abort(HttpResponse::HTTP_FORBIDDEN);
        }

        Comment::destroy($this->comment->id);

        $this->emit('commentDeleted', 'Comment was Successfully Deleted');
    }

    public function render()
    {
        return view('livewire.delete-comment');
    }
}
