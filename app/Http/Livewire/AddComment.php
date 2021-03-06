<?php

namespace App\Http\Livewire;

use App\Http\Livewire\Traits\WithAuthRedirects;
use App\Models\Idea;
use App\Models\Comment;
use App\Notifications\CommentAdded;
use Illuminate\Http\Response as HttpResponse;
use Livewire\Component;

class AddComment extends Component
{
    use WithAuthRedirects;
    
    public $comment;
    public $idea;

    protected $rules = [
        'comment' => 'required|min:4'
    ];

    public function mount(Idea $idea)
    {
        $this->idea = $idea;
    }

    public function addComment()
    {
        if (auth()->guest()) {
            abort(HttpResponse::HTTP_FORBIDDEN);
        }

        $this->validate();

        $newComment = Comment::create([
            'user_id' => auth()->user()->id,
            'idea_id' => $this->idea->id,
            'status_id' => 1,
            'body' => $this->comment
        ]);

        $this->reset('comment');

        $this->emit('commentAdded', 'Comment was added!');

        $this->idea->user->notify(new CommentAdded($newComment));
    }
    public function render()
    {
        return view('livewire.add-comment');
    }
}
