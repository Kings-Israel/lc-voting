<x-app-layout>
    <div class="filters flex space-x-6">
        <div class="w-1/3">
            <select name="category" id="category" class="w-full rounded-xl px-4 py-2 border-none">
                <option value="Category One" id="">Category One</option>
                <option value="Category Two" id="">Category Two</option>
                <option value="Category Three" id="">Category Three</option>
                <option value="Category Four" id="">Category Four</option>
            </select>
        </div>
        <div class="w-1/3">
            <select name="other_filters" id="other_filters" class="w-full rounded-xl px-4 py-2 border-none">
                <option value="Filter One" id="">Filter One</option>
                <option value="Filter Two" id="">Filter Two</option>
                <option value="Filter Three" id="">Filter Three</option>
                <option value="Filter Four" id="">Filter Four</option>
            </select>
        </div>
        <div class="w-2/3 relative">
            <input type="search" name="" placeholder="Find an Idea" class="w-full rounded-xl bg-white border-none px-4 py-2 pl-8 placeholder-gray-900">
            <div class="absolute top-0 flex items-center h-full ml-2">
                <svg class="h-6 w-4 text-gray-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </div>
        </div>
    </div>
    {{-- End filters --}}
    <div class="ideas-container space-y-6 my-6">
        <div class="idea-container bg-white rounded-xl hover:shadow-card cursor-pointer transition duration-150 ease-in flex">
            <div class="border-r border-gray-100 px-5 py-8">
                <div class="text-center">
                    <div class="font-semibold text-2xl">12</div>
                    <div class="text-gray-500">Votes</div>

                    <div class="mt-8">
                        <button class="w-20 bg-gray-200 border border-gray-200 hover:border-gray-400 transition duration-150 ease-in font-bold text-xxs uppercase rounded-xl px-4 py-3">Vote</button>
                    </div>
                </div>
            </div>
            <div class="flex flex-1 px-2 py-6">
                <div class="flex-none">
                    <a href="#">
                        <img src="https://source.unsplash.com/200x200/?face&crop=face&v=1" alt="avatar" class="w-14 h-14 rounded-xl">
                    </a>
                </div>
                <div class="mx-4 w-full">
                    <h4 class="text-xl font-semibold">
                        <a href="#" class="hover:underline">A random title</a>
                    </h4>

                    <div class="text-gray-600 mt-3 line-clamp-3">
                        Lorem ipsum dolor sit amet consectetur.
                    </div>

                    <div class="flex items-center justify-between mt-6">
                        <div class="flex items-center text-xs text-gray-400 font-semibold space-x-2">
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
                                <ul class="absolute w-44 font-semibold bg-white shadow-dialog rounded-xl py-3 text-left ml-8">
                                    <li><a href="#" class="hover:bg-gray-100 block transition duration-150 ease-in px-5 py-3">Mark As Spam</a></li>
                                    <li><a href="#" class="hover:bg-gray-100 block transition duration-150 ease-in px-5 py-3">Delete Post</a></li>
                                </ul>
                            </button>
                        </div>
                    </div>
                </div>

            </div>
        </div> {{-- End Idea Container --}}
        <div class="idea-container bg-white rounded-xl hover:shadow-card cursor-pointer transition duration-150 ease-in flex">
            <div class="border-r border-gray-100 px-5 py-8">
                <div class="text-center">
                    <div class="font-semibold text-2xl">0</div>
                    <div class="text-gray-500">Votes</div>

                    <div class="mt-8">
                        <button class="w-20 bg-gray-200 border border-gray-200 hover:border-gray-400 transition duration-150 ease-in font-bold text-xxs uppercase rounded-xl px-4 py-3">Vote</button>
                    </div>
                </div>
            </div>
            <div class="flex px-2 py-6">
                <a href="#" class="flex-none">
                    <img src="https://source.unsplash.com/200x200/?face&crop=face&v=2" alt="avatar" class="w-14 h-14 rounded-xl">
                </a>
                <div class="mx-4">
                    <h4 class="text-xl font-semibold">
                        <a href="#" class="hover:underline">A random title goes here</a>
                    </h4>

                    <div class="text-gray-600 mt-3 line-clamp-3">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Animi laborum, autem sit voluptatum veritatis nemo ea voluptatem veniam consequuntur maxime nihil in deleniti assumenda eaque eveniet eius architecto quisquam voluptas error. Vel ab fugit soluta, architecto magni neque magnam ipsum.
                    </div>

                    <div class="flex items-center justify-between mt-6">
                        <div class="flex items-center text-xs text-gray-400 font-semibold space-x-2">
                            <div>12 hours ago</div>
                            <div>&bull;</div>
                            <div>Category 2</div>
                            <div>&bull;</div>
                            <div class="text-gray-900">5 Comments</div>
                        </div>
                        <div class="flex items-center space-x-2">
                            <div class="bg-yellow text-xxs font-bold uppercase leading-none rounded-full text-center w-28 h-7 py-2 px-4">Considering</div>
                            <button class="relative bg-gray-100 hover:bg-gray-200 transition duration-150 ease-in rounded-full h-7 py-2 px-3">
                                <img class="w-7 -my-5" src="{{ asset('img/three-dots.svg') }}" alt="">
                                {{-- <ul class="absolute w-44 font-semibold bg-white shadow-dialog rounded-xl py-3 text-left ml-8">
                                    <li><a href="#" class="hover:bg-gray-100 block transition duration-150 ease-in px-5 py-3">Mark As Spam</a></li>
                                    <li><a href="#" class="hover:bg-gray-100 block transition duration-150 ease-in px-5 py-3">Delete Post</a></li>
                                </ul> --}}
                            </button>
                        </div>
                    </div>
                </div>

            </div>
        </div> {{-- End Idea Container --}}
        <div class="idea-container bg-white rounded-xl hover:shadow-card cursor-pointer transition duration-150 ease-in flex">
            <div class="border-r border-gray-100 px-5 py-8">
                <div class="text-center">
                    <div class="font-semibold text-2xl">8</div>
                    <div class="text-gray-500">Votes</div>

                    <div class="mt-8">
                        <button class="w-20 bg-gray-200 border border-gray-200 hover:border-gray-400 transition duration-150 ease-in font-bold text-xxs uppercase rounded-xl px-4 py-3">Vote</button>
                    </div>
                </div>
            </div>
            <div class="flex px-2 py-6">
                <a href="#" class="flex-none">
                    <img src="https://source.unsplash.com/200x200/?face&crop=face&v=1" alt="avatar" class="w-14 h-14 rounded-xl">
                </a>
                <div class="mx-4">
                    <h4 class="text-xl font-semibold">
                        <a href="#" class="hover:underline">Another random title</a>
                    </h4>

                    <div class="text-gray-600 mt-3 line-clamp-3">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Animi laborum, autem sit voluptatum veritatis nemo ea voluptatem veniam consequuntur maxime nihil in deleniti assumenda eaque eveniet eius architecto quisquam voluptas error. Vel ab fugit soluta, architecto magni neque magnam ipsum.
                    </div>

                    <div class="flex items-center justify-between mt-6">
                        <div class="flex items-center text-xs text-gray-400 font-semibold space-x-2">
                            <div>4 hours ago</div>
                            <div>&bull;</div>
                            <div>Category 3</div>
                            <div>&bull;</div>
                            <div class="text-gray-900">12 Comments</div>
                        </div>
                        <div class="flex items-center space-x-2">
                            <div class="bg-green text-xxs font-bold uppercase leading-none rounded-full text-center w-28 h-7 py-2 px-4">Implemented</div>
                            <button class="relative bg-gray-100 hover:bg-gray-200 transition duration-150 ease-in rounded-full h-7 py-2 px-3">
                                <img class="w-7 -my-5" src="{{ asset('img/three-dots.svg') }}" alt="">
                                {{-- <ul class="absolute w-44 font-semibold bg-white shadow-dialog rounded-xl py-3 text-left ml-8">
                                    <li><a href="#" class="hover:bg-gray-100 block transition duration-150 ease-in px-5 py-3">Mark As Spam</a></li>
                                    <li><a href="#" class="hover:bg-gray-100 block transition duration-150 ease-in px-5 py-3">Delete Post</a></li>
                                </ul> --}}
                            </button>
                        </div>
                    </div>
                </div>

            </div>
        </div> {{-- End Idea Container --}}
        <div class="idea-container bg-white rounded-xl hover:shadow-card cursor-pointer transition duration-150 ease-in flex">
            <div class="border-r border-gray-100 px-5 py-8">
                <div class="text-center">
                    <div class="font-semibold text-2xl">12</div>
                    <div class="text-gray-500">Votes</div>

                    <div class="mt-8">
                        <button class="w-20 bg-gray-200 border border-gray-200 hover:border-gray-400 transition duration-150 ease-in font-bold text-xxs uppercase rounded-xl px-4 py-3">Vote</button>
                    </div>
                </div>
            </div>
            <div class="flex px-2 py-6">
                <a href="#" class="flex-none">
                    <img src="https://source.unsplash.com/200x200/?face&crop=face&v=1" alt="avatar" class="w-14 h-14 rounded-xl">
                </a>
                <div class="mx-4">
                    <h4 class="text-xl font-semibold">
                        <a href="#" class="hover:underline">New random title</a>
                    </h4>

                    <div class="text-gray-600 mt-3 line-clamp-3">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Animi laborum, autem sit voluptatum veritatis nemo ea voluptatem veniam consequuntur maxime nihil in deleniti assumenda eaque eveniet eius architecto quisquam voluptas error. Vel ab fugit soluta, architecto magni neque magnam ipsum.
                    </div>

                    <div class="flex items-center justify-between mt-6">
                        <div class="flex items-center text-xs text-gray-400 font-semibold space-x-2">
                            <div>23 hours ago</div>
                            <div>&bull;</div>
                            <div>Category 4</div>
                            <div>&bull;</div>
                            <div class="text-gray-900">2 Comments</div>
                        </div>
                        <div class="flex items-center space-x-2">
                            <div class="bg-purple text-xxs font-bold uppercase leading-none rounded-full text-center w-28 h-7 py-2 px-4">In Progress</div>
                            <button class="relative bg-gray-100 hover:bg-gray-200 transition duration-150 ease-in rounded-full h-7 py-2 px-3">
                                <img class="w-7 -my-5" src="{{ asset('img/three-dots.svg') }}" alt="">
                                {{-- <ul class="absolute w-44 font-semibold bg-white shadow-dialog rounded-xl py-3 text-left ml-8">
                                    <li><a href="#" class="hover:bg-gray-100 block transition duration-150 ease-in px-5 py-3">Mark As Spam</a></li>
                                    <li><a href="#" class="hover:bg-gray-100 block transition duration-150 ease-in px-5 py-3">Delete Post</a></li>
                                </ul> --}}
                            </button>
                        </div>
                    </div>
                </div>

            </div>
        </div> {{-- End Idea Container --}}
        <div class="idea-container bg-white rounded-xl hover:shadow-card cursor-pointer transition duration-150 ease-in flex">
            <div class="border-r border-gray-100 px-5 py-8">
                <div class="text-center">
                    <div class="font-semibold text-2xl text-blue">12</div>
                    <div class="text-blue">Votes</div>

                    <div class="mt-8">
                        <button class="w-20 bg-blue border border-gray-200 hover:border-gray-400 transition duration-150 ease-in font-bold text-xxs uppercase rounded-xl px-4 py-3">Voted</button>
                    </div>
                </div>
            </div>
            <div class="flex px-2 py-6">
                <a href="#" class="flex-none">
                    <img src="https://source.unsplash.com/200x200/?face&crop=face&v=5" alt="avatar" class="w-14 h-14 rounded-xl">
                </a>
                <div class="mx-4">
                    <h4 class="text-xl font-semibold">
                        <a href="#" class="hover:underline">A random title</a>
                    </h4>

                    <div class="text-gray-600 mt-3 line-clamp-3">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Animi laborum, autem sit voluptatum veritatis nemo ea voluptatem veniam consequuntur maxime nihil in deleniti assumenda eaque eveniet eius architecto quisquam voluptas error. Vel ab fugit soluta, architecto magni neque magnam ipsum.
                    </div>

                    <div class="flex items-center justify-between mt-6">
                        <div class="flex items-center text-xs text-gray-400 font-semibold space-x-2">
                            <div>10 hours ago</div>
                            <div>&bull;</div>
                            <div>Category 1</div>
                            <div>&bull;</div>
                            <div class="text-gray-900">3 Comments</div>
                        </div>
                        <div class="flex items-center space-x-2">
                            <div class="bg-red text-xxs font-bold uppercase leading-none rounded-full text-center w-28 h-7 py-2 px-4">Closed</div>
                            <button class="relative bg-gray-100 hover:bg-gray-200 transition duration-150 ease-in rounded-full h-7 py-2 px-3">
                                <img class="w-7 -my-5" src="{{ asset('img/three-dots.svg') }}" alt="">
                                {{-- <ul class="absolute w-44 font-semibold bg-white shadow-dialog rounded-xl py-3 text-left ml-8">
                                    <li><a href="#" class="hover:bg-gray-100 block transition duration-150 ease-in px-5 py-3">Mark As Spam</a></li>
                                    <li><a href="#" class="hover:bg-gray-100 block transition duration-150 ease-in px-5 py-3">Delete Post</a></li>
                                </ul> --}}
                            </button>
                        </div>
                    </div>
                </div>

            </div>
        </div> {{-- End Idea Container --}}
    </div> {{-- End Ideas container --}}
</x-app-layout>
