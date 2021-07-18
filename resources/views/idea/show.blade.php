<x-app-layout>
    <div>
        <a href="{{ $backUrl }}" class="flex items-center font-semibold hover:underline">
            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
              </svg>
            <span class="ml-2">All Ideas (or back to chosen category with filters)</span>
        </a>
    </div>

    <livewire:idea-show :idea="$idea" :votesCount="$votesCount"  />

    <livewire:edit-idea />

    <div class="comments-container relative space-y-6 pt-4 md:ml-22 my-8 mt-1">
        @foreach (range(1, 3) as $comment)

            <div class="comment-container relative bg-white rounded-xl mt-1 flex">
                <div class="flex flex-col md:flex-row flex-1 px-4 py-6">
                    <div class="flex-none">
                        <a href="#">
                            <img src="https://source.unsplash.com/200x200/?face&crop=face&v=2" alt="avatar" class="w-14 h-14 rounded-xl">
                        </a>
                    </div>
                    <div class="md:mx-4 w-full">

                        <div class="text-gray-600 mt-3">
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolorem, culpa maxime dicta et dolore ab facere maiores eveniet repellendus consectetur. Lorem ipsum dolor sit amet consectetur adipisicing elit.
                        </div>

                        <div class="flex items-center justify-between mt-6">
                            <div class="flex items-center text-xs text-gray-400 font-semibold space-x-2">
                                <div class="font-bold text-gray-900">John Doe</div>
                                <div>&bull;</div>
                                <div>10 hours ago</div>
                            </div>
                            <div class="flex items-center space-x-2" x-data="{ isOpen: false }">
                                <div class="relative">
                                    <button class="relative bg-gray-100 hover:bg-gray-200 transition duration-150 ease-in rounded-full border h-7 py-2 px-3" @click="isOpen = !isOpen">
                                        <img class="w-7 -my-5" src="{{ asset('img/three-dots.svg') }}" alt="" >
                                    </button>
                                </div>
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
            </div>{{-- End Comment Container --}}
        @endforeach
    </div>{{-- End Comments Container --}}
</x-app-layout>
