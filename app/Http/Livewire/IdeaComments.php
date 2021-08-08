<?php

namespace App\Http\Livewire;

use App\Models\Comment;
use App\Models\Idea;
use Livewire\Component;
use Livewire\WithPagination;

class IdeaComments extends Component
{
    use WithPagination;

    public $idea;

    protected $listeners = ['commentAdded', 'commentDeleted', 'statusUpdated'];

    public function commentAdded()
    {
        $this->idea->refresh();
        $this->gotoPage($this->idea->comments()->paginate()->lastPage());
    }

    public function statusUpdated()
    {
        $this->idea->refresh();
        $this->gotoPage($this->idea->comments()->paginate()->lastPage());
    }

    public function commentDeleted()
    {
        $this->idea->refresh();
        $this->gotoPage(1);
    }

    public function mount(Idea $idea)
    {
        $this->idea = $idea;
    }

    public function render()
    {
        return view('livewire.idea-comments', [
            // 'comments' => $this->idea->comments()->paginate()->withQueryString()
            'comments' => Comment::with('user', 'status')->where('idea_id', $this->idea->id)->paginate()->withQueryString()
        ]);
    }
}
