<div class="comment-container relative bg-white rounded-xl mt-1 flex">
    <div class="flex flex-col md:flex-row flex-1 px-4 py-6">
        <div class="flex-none">
            <a href="#">
                <img src="{{ $comment->user->getAvatar() }}" alt="avatar" class="w-14 h-14 rounded-xl">
            </a>
        </div>
        <div class="md:mx-4 w-full">

            <div class="text-gray-600">
                {{ $comment->body }}
            </div>

            <div class="flex items-center justify-between mt-6">
                <div class="flex items-center text-xs text-gray-400 font-semibold space-x-2">
                    <div class="font-bold text-gray-900">{{ $comment->user->name }}</div>
                    <div>&bull;</div>
                    <div>{{ $comment->created_at->diffForHumans() }}</div>
                </div>
                <div class="flex items-center space-x-2" x-data="{ isOpen: false }">
                    <div class="relative">
                        <button class="relative bg-gray-100 hover:bg-gray-200 transition duration-150 ease-in rounded-full border h-7 py-2 px-3" @click="isOpen = !isOpen">
                            <img class="w-7 -my-5" src="{{ asset('img/three-dots.svg') }}" alt="" >
                        </button>
                        <ul
                            x-cloak
                            x-show.transition.origin.top.left.duration.150ms="isOpen"
                            @click.away="isOpen = false"
                            @keydown.escape.window = "isOpen = false"
                            class="absolute w-44 font-semibold bg-white shadow-dialog rounded-xl py-3 z-10 text-left md:ml-8 top-8 md:top-6 right-0 md:left-0">
                            <li><a href="#" class="hover:bg-gray-100 block transition duration-150 ease-in px-5 py-3">Mark As Spam</a></li>
                            <li><a href="#" class="hover:bg-gray-100 block transition duration-150 ease-in px-5 py-3">Delete Comment</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>{{-- End Comment Container --}}
