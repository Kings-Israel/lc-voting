<x-app-layout>
    <div>
        <a href="/" class="flex items-center font-semibold hover:underline">
            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
              </svg>
            <span class="ml-2">All Ideas</span>
        </a>
    </div>

    <div class="idea-container bg-white rounded-xl mt-1 flex">
        <div class="flex flex-1 px-4 py-6">
            <div class="flex-none">
                <a href="#">
                    <img src="https://source.unsplash.com/200x200/?face&crop=face&v=1" alt="avatar" class="w-14 h-14 rounded-xl">
                </a>
            </div>
            <div class="mx-4 w-full">
                <h4 class="text-xl font-semibold">
                    <a href="#" class="hover:underline">A random title</a>
                </h4>

                <div class="text-gray-600 mt-3">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolorem, culpa maxime dicta et dolore ab facere maiores eveniet repellendus consectetur. Lorem ipsum dolor sit amet consectetur adipisicing elit. Ex odio earum alias cupiditate quae distinctio. Quibusdam nemo dolor exercitationem distinctio.
                </div>

                <div class="flex items-center justify-between mt-6">
                    <div class="flex items-center text-xs text-gray-400 font-semibold space-x-2">
                        <div class="font-bold text-gray-900">John Doe</div>
                        <div>&bull;</div>
                        <div>10 hours ago</div>
                        <div>&bull;</div>
                        <div>Category 1</div>
                        <div>&bull;</div>
                        <div class="text-gray-900">3 Comments</div>
                    </div>
                    <div class="flex items-center space-x-2">
                        <div class="bg-gray-200 text-xxs font-bold uppercase leading-none rounded-full text-center w-28 h-7 py-2 px-4">Open</div>
                        <button class="relative bg-gray-100 hover:bg-gray-200 transition duration-150 ease-in rounded-full border h-7 py-2 px-3">
                            <img class="w-7 -my-5" src="{{ asset('img/three-dots.svg') }}" alt="">
                            <ul class="hidden absolute w-44 font-semibold bg-white shadow-dialog rounded-xl py-3 text-left ml-8">
                                <li><a href="#" class="hover:bg-gray-100 block transition duration-150 ease-in px-5 py-3">Mark As Spam</a></li>
                                <li><a href="#" class="hover:bg-gray-100 block transition duration-150 ease-in px-5 py-3">Delete Post</a></li>
                            </ul>
                        </button>
                    </div>
                </div>
            </div>

        </div>
    </div> {{-- End Idea Container --}}

    <div class="button-container flex items-center justify-between">
        <div class="flex items-center space-x-4 ml-6">
            <button type="button" class="bg-blue flex items-center justify-center w-32 text-xs bg-gray-200 font-semibold rounded-xl border border-blue hover:bg-blue-hover transition duration-150 ease-in px-6 py-3 text-white">
                <span>Reply</span>
            </button>
            <button type="button" class="flex items-center justify-center w-36 h-11 text-xs bg-gray-200 font-semibold rounded-xl border border-gray-200 hover:border-gray-400 transition duration-150 ease-in px-6 py-3">
                <span>Set Status</span>
                <svg class="h-4 w-4 ml-2" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                  </svg>
            </button>
        </div>
        <div class="flex items-center space-x-3">
            <div class="bg-white font-semibold text-center rounded-xl px-2 py-2">
                <div class="text-xl leading-snug">
                    12
                </div>
                <div class="text-gray-400 text-xs leading-none">Votes</div>
            </div>
            <button type="button" class="items-center justify-center w-32 h-11 text-xs bg-gray-200 font-semibold rounded-xl border border-gray-200 hover:border-gray-400 transition duration-150 ease-in px-6 py-3 uppercase">
                <span>Vote</span>
            </button>
        </div>
    </div>{{-- End Buttons container --}}

    <div class="comments-container relative space-y-6 pt-4 ml-22 my-8 mt-1">
        <div class="comment-container relative bg-white rounded-xl mt-1 flex">
            <div class="flex flex-1 px-4 py-6">
                <div class="flex-none">
                    <a href="#">
                        <img src="https://source.unsplash.com/200x200/?face&crop=face&v=2" alt="avatar" class="w-14 h-14 rounded-xl">
                    </a>
                </div>
                <div class="mx-4 w-full">
                    {{-- <h4 class="text-xl font-semibold">
                        <a href="#" class="hover:underline">A random title</a>
                    </h4> --}}
    
                    <div class="text-gray-600 mt-3">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolorem, culpa maxime dicta et dolore ab facere maiores eveniet repellendus consectetur. Lorem ipsum dolor sit amet consectetur adipisicing elit.
                    </div>
    
                    <div class="flex items-center justify-between mt-6">
                        <div class="flex items-center text-xs text-gray-400 font-semibold space-x-2">
                            <div class="font-bold text-gray-900">John Doe</div>
                            <div>&bull;</div>
                            <div>10 hours ago</div>
                        </div>
                        <div class="flex items-center space-x-2">
                            <button class="relative bg-gray-100 hover:bg-gray-200 transition duration-150 ease-in rounded-full border h-7 py-2 px-3">
                                <img class="w-7 -my-5" src="{{ asset('img/three-dots.svg') }}" alt="">
                                <ul class="hidden absolute w-44 font-semibold bg-white shadow-dialog rounded-xl py-3 text-left ml-8">
                                    <li><a href="#" class="hover:bg-gray-100 block transition duration-150 ease-in px-5 py-3">Mark As Spam</a></li>
                                    <li><a href="#" class="hover:bg-gray-100 block transition duration-150 ease-in px-5 py-3">Delete Post</a></li>
                                </ul>
                            </button>
                        </div>
                    </div>
                </div>
    
            </div>
        </div>{{-- End Comment Container --}}
        <div class="comment-container relative is-admin bg-white rounded-xl mt-1 flex">
            <div class="flex flex-1 px-4 py-6">
                <div class="flex-none">
                    <a href="#">
                        <img src="https://source.unsplash.com/200x200/?face&crop=face&v=3" alt="avatar" class="w-14 h-14 rounded-xl">
                    </a>
                    <div class="text-center uppercase text-blue text-xxs font-bold mt-1">Admin</div>
                </div>
                <div class="mx-4 w-full">
                    <h4 class="text-xl font-semibold">
                        <a href="#" class="hover:underline">Status Changed to Under Construction</a>
                    </h4>
    
                    <div class="text-gray-600 mt-3">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolorem, culpa maxime dicta et dolore ab facere maiores eveniet repellendus consectetur.
                    </div>
    
                    <div class="flex items-center justify-between mt-6">
                        <div class="flex items-center text-xs text-gray-400 font-semibold space-x-2">
                            <div class="font-bold text-blue">Andrea</div>
                            <div>&bull;</div>
                            <div>10 hours ago</div>
                        </div>
                        <div class="flex items-center space-x-2">
                            <button class="relative bg-gray-100 hover:bg-gray-200 transition duration-150 ease-in rounded-full border h-7 py-2 px-3">
                                <img class="w-7 -my-5" src="{{ asset('img/three-dots.svg') }}" alt="">
                                <ul class="hidden absolute w-44 font-semibold bg-white shadow-dialog rounded-xl py-3 text-left ml-8">
                                    <li><a href="#" class="hover:bg-gray-100 block transition duration-150 ease-in px-5 py-3">Mark As Spam</a></li>
                                    <li><a href="#" class="hover:bg-gray-100 block transition duration-150 ease-in px-5 py-3">Delete Post</a></li>
                                </ul>
                            </button>
                        </div>
                    </div>
                </div>
    
            </div>
        </div>{{-- End Comment Container --}}
        <div class="comment-container relative bg-white rounded-xl mt-1 flex">
            <div class="flex flex-1 px-4 py-6">
                <div class="flex-none">
                    <a href="#">
                        <img src="https://source.unsplash.com/200x200/?face&crop=face&v=4" alt="avatar" class="w-14 h-14 rounded-xl">
                    </a>
                </div>
                <div class="mx-4 w-full">
                    {{-- <h4 class="text-xl font-semibold">
                        <a href="#" class="hover:underline">A random title</a>
                    </h4> --}}
    
                    <div class="text-gray-600 mt-3">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolorem, culpa maxime dicta et dolore ab facere maiores eveniet repellendus consectetur. Lorem ipsum dolor sit amet consectetur adipisicing elit.
                    </div>
    
                    <div class="flex items-center justify-between mt-6">
                        <div class="flex items-center text-xs text-gray-400 font-semibold space-x-2">
                            <div class="font-bold text-gray-900">John Doe</div>
                            <div>&bull;</div>
                            <div>10 hours ago</div>
                        </div>
                        <div class="flex items-center space-x-2">
                            <button class="relative bg-gray-100 hover:bg-gray-200 transition duration-150 ease-in rounded-full border h-7 py-2 px-3">
                                <img class="w-7 -my-5" src="{{ asset('img/three-dots.svg') }}" alt="">
                                <ul class="hidden absolute w-44 font-semibold bg-white shadow-dialog rounded-xl py-3 text-left ml-8">
                                    <li><a href="#" class="hover:bg-gray-100 block transition duration-150 ease-in px-5 py-3">Mark As Spam</a></li>
                                    <li><a href="#" class="hover:bg-gray-100 block transition duration-150 ease-in px-5 py-3">Delete Post</a></li>
                                </ul>
                            </button>
                        </div>
                    </div>
                </div>
    
            </div>
        </div>{{-- End Comment Container --}}
    </div>{{-- End Comments Container --}}
</x-app-layout>
