<div>
    @if ($comments->isNotEmpty())
        <div class="comments-container relative space-y-6 pt-4 md:ml-22 my-8 mt-1">
            @foreach ($comments as $comment)
                <livewire:idea-comment :key="$comment->id" :comment="$comment" :ideaUserId="$idea->user->id" />
            @endforeach
        </div>{{-- End Comments Container --}}
    @else
        <div class="mx-auto w-70 mt-12">
            <div class="text-gray-400 text-center font-bold mt-6">No Comments Yet...</div>
        </div>
    @endif
</div>
