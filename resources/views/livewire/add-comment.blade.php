<div
    x-data="{ isOpen: false }"
    x-init="
        Livewire.on('commentAdded', () => {
            isOpen = false
        })

        Livewire.hook('message.processed', (message, component) => {
            {{-- Pagination --}}
            if(['gotoPage', 'previousPage', 'nextPage'].includes(message.updateQueue[0].method)) {
                const firstComment = document.querySelector('.comment-container:first-child')
                firstComment.scrollIntoView({ behavior: 'smooth'})
            }

            {{-- Adding Comment --}}
            if(['commentAdded', 'statusUpdated'].includes(message.updateQueue[0].payload.event) && message.component.fingerprint.name === 'idea-comments') {
                const lastComment = document.querySelector('.comment-container:last-child')
                lastComment.scrollIntoView({ behavior: 'smooth'})
                lastComment.classList.add('bg-green-50')
                setTimeout(() => {
                    lastComment.classList.remove('bg-green-50')
                }, 5000)
            }
        })

        @if(session('scrollToComment'))
            const commentToScrollTo = document.querySelector('#comment-{{ session('scrollToComment') }}')
            commentToScollTo.scrollIntoView({ behavior: 'smooth'})
            commentToScollTo.classList.add('bg-green-50')
            setTimeout(() => {
                commentToScollTo.classList.remove('bg-green-50')
            }, 5000)
        @endif
    "
    class="relative"
>
    <button
            type="button"
            @click="
                isOpen = !isOpen
                if(isOpen) {
                    $nextTick(() => $refs.comment.focus())
                }
            "
            class="bg-blue flex items-center justify-center w-32 text-sm text-xs bg-gray-200 font-semibold rounded-xl border border-blue hover:bg-blue-hover transition duration-150 ease-in px-6 py-3 text-white">
        <span>Reply</span>
    </button>
        <div
            x-cloak
            x-show.transition.origin.top.left.duration.150ms="isOpen"
            @click.away="isOpen = false"
            @keydown.escape.window = "isOpen = false"
            class="absolute z-10 w-64 md:w-104 text-left font-semibold rounded-xl text-sm bg-white shadow-dialog mt-2">
            @auth
                <form action="" wire:submit.prevent="addComment" class="space-y-4 px-4 py-6">
                    <div>
                        <textarea wire:model="comment" x-ref="comment" name="post_comment" cols="30" rows="4" class="w-full text-sm bg-gray-100 rounded-xl placeholder-gray-900 border-none px-4 py-2" placeholder="Go Ahead, share your thoughts"></textarea>
                    </div>
                    <div class="flex flex-col md:flex-row items-center md:space-x-3">
                        <button type="submit" class="bg-blue flex items-center justify-center w-full md:w-1/2 text-sm text-xs bg-gray-200 font-semibold rounded-xl border border-blue hover:bg-blue-hover transition duration-150 ease-in px-6 py-3 text-white">
                            <span>Post Comment</span>
                        </button>
                        <button type="button" class="flex items-center justify-center w-full md:w-32 h-11 text-xs bg-gray-200 font-semibold rounded-xl border border-gray-200 hover:border-gray-400 transition duration-150 ease-in px-6 py-3 mt-2 md:mt-0">
                            <svg class="text-gray-600 w-4 transform -rotate-45" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13" />
                            </svg>
                            <span class="ml-1">Attach</span>
                        </button>
                    </div>
                </form>
            @else
                <div class="px-4 py-6">
                    <p class="font-normal">Please login or sign up to post a comment.</p>
                    <div class="flex items-center space-x-3 mt-8">
                        <a href="{{ route('login') }}" class="w-1/2 h-11 text-sm text-center bg-blue text-white font-semibold rounded-xl hover:bg-blue-hover transition duration-150 ease-in px-6 py-3">Login</a>
                        <a href="{{ route('register') }}" class="w-1/2 h-11 text-sm text-center bg-gray-200 font-semibold rounded-xl border-gray-200 hover:border-gray-400 transition duration-150 ease-in px-6 py-3">Sign Up</a>
                    </div>
                </div>
            @endauth
        </div>
</div>
