<?php

namespace App\Http\Livewire;

use App\Models\Comment;
use App\Models\Idea;
use Illuminate\Http\Response as HttpResponse;
use Illuminate\Notifications\DatabaseNotification;
use Livewire\Component;

class CommentNotifications extends Component
{
    const NOTIFICATION_THRESHOLD = 3;

    public $notifications;
    PUBLIC $notificationCount;
    public $isLoading;

    protected $listeners = ['getNotifications'];

    public function mount()
    {
        $this->notifications = collect([]);
        $this->isLoading = true;
        $this->getNotificationsCount();
    }

    public function markAsRead($notification)
    {
        if (auth()->guest()) {
            abort(HttpResponse::HTTP_FORBIDDEN);
        }

        $notification = DatabaseNotification::findOrFail($notification);
        $notification->markAsRead();

        $this->scrollToComment($notification);
    }

    public function scrollToComment($notification)
    {
        $idea = Idea::find($notification->data['idea_id']);

        if(! $idea) {
            session()->flash('error_message', 'This idea no longer exists');

            return redirect()->route('idea.index');
        }

        $comment = Comment::find($notification->data['comment_id']);
        if (! $comment) {
            session()->flash('error_message', 'This comment no longer exists');

            return redirect()->route('idea.index');
        }

        $comments = $idea->comments()->pluck('id');
        $indexOfComment = $comments->search($comment->id);

        $page = (int) ($indexOfComment / $comment->getPerPage()) + 1;

        session()->flash('scrollToComment', $comment->id);

        return redirect()->route('idea.show', [
            'idea' => $notification->data['idea_slug'],
            'page' => $page
        ]);
    }

    public function markAllAsRead()
    {
        if (auth()->guest()) {
            abort(HttpResponse::HTTP_FORBIDDEN);
        }

        auth()->user()->unreadNotifications->markAsRead();
        $this->getNotificationsCount();
        $this->getNotifications();
    }

    public function getNotificationsCount()
    {
        $this->notificationCount = auth()->user()->unreadNotifications()->count();

        if ($this->notificationCount > self::NOTIFICATION_THRESHOLD) {
            $this->notificationCount = self::NOTIFICATION_THRESHOLD.'+';
        }
    }

    public function getNotifications()
    {
        $this->notifications = auth()->user()
            ->unreadNotifications()
            ->latest()
            ->take(self::NOTIFICATION_THRESHOLD)
            ->get();

        $this->isLoading = false;
    }

    public function render()
    {
        return view('livewire.comment-notifications');
    }
}
