<?php

namespace App\Http\Livewire;

use App\Models\Idea;
use App\Models\Comment;
use Illuminate\Http\Response as HttpResponse;
use Livewire\Component;

class AddComment extends Component
{
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

        Comment::create([
            'user_id' => auth()->user()->id,
            'idea_id' => $this->idea->id,
            'body' => $this->comment
        ]);

        $this->reset('comment');

        $this->emit('commentAdded', 'Comment was added!');
    }
    public function render()
    {
        return view('livewire.add-comment');
    }
}
