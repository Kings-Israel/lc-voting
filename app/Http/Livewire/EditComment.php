<?php

namespace App\Http\Livewire;

use App\Models\Comment;
use Illuminate\Http\Response as HttpResponse;
use Livewire\Component;

class EditComment extends Component
{
    public Comment $comment;
    public $body;

    protected $listeners = ['setEditComment'];

    protected $rules = [
        'body' => 'required|min:4'
    ];

    public function setEditComment($commentId)
    {
        $this->comment = Comment::findOrFail($commentId);
        $this->body = $this->comment->body;

        $this->emit('editCommentSet');
    }

    public function updateComment()
    {
        if (auth()->guest() || auth()->user()->cannot('update', $this->comment)) {
            abort(HttpResponse::HTTP_FORBIDDEN);
        }

        $this->validate();

        $this->comment->update([
            'body' => $this->body
        ]);

        $this->emit('commentUpdated', 'Comment was Successfully Updated');
    }

    public function render()
    {
        return view('livewire.edit-comment');
    }
}
