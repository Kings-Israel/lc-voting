<div class="idea-and-buttons-container">
    <div class="idea-container bg-white rounded-xl mt-1 flex">
        <div class="flex flex-col md:flex-row flex-1 px-4 py-6">
            <div class="flex-none mx-2 md:mx-0">
                <a href="#">
                    <img src="{{ $idea->user->getAvatar() }}" alt="avatar" class="w-14 h-14 rounded-xl">
                </a>
            </div>
            <div class="mx-2 w-full">
                <h4 class="text-xl font-semibold">
                    <a href="#" class="hover:underline">{{ $idea->title }}</a>
                </h4>

                <div class="text-gray-600 mt-3">
                    {{ $idea->description }}
                </div>

                <div class="flex flex-col md:flex-row md:items-center justify-between mt-6">
                    <div class="flex md:items-center text-xs text-gray-400 font-semibold md:space-x-2">
                        <div class="font-bold text-gray-900 hidden md:block">{{ $idea->user->name }}</div>
                        <div class="hidden md:block">&bull;</div>
                        <div>{{ $idea->created_at->diffForHumans() }}</div>
                        <div>&bull;</div>
                        <div>{{ $idea->category->name }}</div>
                        <div>&bull;</div>
                        <div class="text-gray-900">3 Comments</div>
                    </div>
                    <div class="flex mt-4 md:mt-0 items-center space-x-2" x-data="{ isOpen: false }">
                        <div class="{{ $idea->status->classes }} text-xxs font-bold uppercase leading-none rounded-full text-center w-28 h-7 py-2 px-4">{{ $idea->status->name }}</div>
                        <button class="relative bg-gray-100 hover:bg-gray-200 transition duration-150 ease-in rounded-full border h-7 py-2 px-3" @click="isOpen = !isOpen">
                            <img class="w-7 -my-5" src="{{ asset('img/three-dots.svg') }}" alt="">
                            <ul
                                x-cloak
                                x-show.transition.origin.top.left.duration.150ms="isOpen"
                                @click.away="isOpen = false"
                                @keydown.escape.window = "isOpen = false"
                                class="absolute w-44 font-semibold bg-white shadow-dialog rounded-xl py-3 text-left z-10 md:ml-8 top-8 md:top-6 right-0 md:left-0">
                                <li><a href="#" class="hover:bg-gray-100 block transition duration-150 ease-in px-5 py-3">Mark As Spam</a></li>
                                <li><a href="#" class="hover:bg-gray-100 block transition duration-150 ease-in px-5 py-3">Delete Post</a></li>
                            </ul>
                        </button>
                    </div>

                    <div class="flex items-center md:hidden mt-4 md:mt-0 md">
                        <div class="bg-gray-100 text-center-rounded-xl h-10 px-4 py-2 pr-8">
                            <div class="text-sm font-bold leading-none">{{ $votesCount }}</div>
                            <div class="text-xxs leading-none font-semibold text-gray-400 uppercase">Votes</div>
                        </div>
                        <button class="w-20 bg-gray-200 font-bold text-xxs uppercase rounded-xl hover:border-gray-400 transition duration-150 ease-in px-4 py-3 -mx-5">Vote</button>
                    </div>
                </div>
            </div>

        </div>
    </div> {{-- End Idea Container --}}

    <div class="button-container flex items-center justify-between">
        <div class="flex flex-col md:flex-row items-center space-x-4 md:ml-6">
            <div x-data="{ isOpen: false }" class="relative">
                <button type="button" @click="isOpen = !isOpen" class="bg-blue flex items-center justify-center w-32 text-sm text-xs bg-gray-200 font-semibold rounded-xl border border-blue hover:bg-blue-hover transition duration-150 ease-in px-6 py-3 text-white">
                    <span>Reply</span>
                </button>
                <div
                    x-cloak
                    x-show.transition.origin.top.left.duration.150ms="isOpen"
                    @click.away="isOpen = false"
                    @keydown.escape.window = "isOpen = false"
                    class="absolute z-10 w-64 md:w-104 text-left font-semibold rounded-xl text-sm bg-white shadow-dialog mt-2">
                    <form action="" class="space-y-4 px-4 py-6">
                        <div>
                            <textarea name="post_comment" id="" cols="30" rows="4" class="w-full text-sm bg-gray-100 rounded-xl placeholder-gray-900 border-none px-4 py-2" placeholder="Go Ahead, share your thoughts"></textarea>
                        </div>
                        <div class="flex flex-col md:flex-row items-center md:space-x-3">
                            <button type="button" class="bg-blue flex items-center justify-center w-full md:w-1/2 text-sm text-xs bg-gray-200 font-semibold rounded-xl border border-blue hover:bg-blue-hover transition duration-150 ease-in px-6 py-3 text-white">
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
                </div>
            </div>
            <div x-data="{ isOpen: false }" class="relative">
                <button type="button" @click="isOpen = !isOpen" class="flex items-center justify-center w-36 h-11 text-sm bg-gray-200 font-semibold rounded-xl border border-gray-200 hover:border-gray-400 transition duration-150 ease-in px-6 py-3 mt-2 md:mt-0">
                    <span>Set Status</span>
                    <svg class="h-4 w-4 ml-2" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                      </svg>
                </button>
                <div
                    x-cloak
                    x-show.transition.origin.top.left.duration.150ms="isOpen"
                    @click.away="isOpen = false"
                    @keydown.escape.window = "isOpen = false"
                    class="absolute z-20 w-64 md:w-76 text-left font-semibold rounded-xl text-sm bg-white shadow-dialog mt-2">
                    <form action="" class="space-y-4 px-4 py-6">
                        <div class="space-y-2">
                            <div>
                                <label for="" class="inline-flex items-center"></label>
                                <input type="radio" checked="" class="bg-gray-200 text-gray border-none" name="status" id="" value="open">
                                <span class="ml-2">Open</span>
                            </div>
                            <div>
                                <label for="" class="inline-flex items-center"></label>
                                <input type="radio" name="status" class="bg-gray-200 text-purple border-none" id="" value="considering">
                                <span class="ml-2">Considering</span>
                            </div>
                            <div>
                                <label for="" class="inline-flex items-center"></label>
                                <input type="radio" name="status" class="bg-gray-200 text-yellow border-none" id="" value="in progress">
                                <span class="ml-2">In Progess</span>
                            </div>
                            <div>
                                <label for="" class="inline-flex items-center"></label>
                                <input type="radio" name="status" class="bg-gray-200 text-green border-none" id="" value="implemented">
                                <span class="ml-2">Implemented</span>
                            </div>
                            <div>
                                <label for="" class="inline-flex items-center"></label>
                                <input type="radio" name="status" class="bg-gray-200 text-red border-none" id="" value="closed">
                                <span class="ml-2">Closed</span>
                            </div>
                        </div>

                        <div>
                            <textarea name="update_comment" id="" cols="30" rows="3" class="w-full text-sm bg-gray-100 rounded-xl placeholder-gray-900 border-none px-4 py-2" placeholder="Add an update comment (optional)"></textarea>
                        </div>

                        <div class="flex items-center justify-between space-x-3">
                            <button type="button" class="flex items-center justify-center w-1/2 h-11 text-xs bg-gray-200 font-semibold rounded-xl border border-gray-200 hover:border-gray-400 transition duration-150 ease-in px-6 py-3">
                                <svg class="text-gray-600 w-4 transform -rotate-45" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13" />
                                  </svg>
                                <span class="ml-1">Attach</span>
                            </button>
                            <button type="submit" class="bg-blue flex items-center justify-center w-1/2 h-11 text-xs bg-gray-200 font-semibold rounded-xl border border-blue hover:bg-blue-hover transition duration-150 ease-in px-6 py-3 text-white">
                                <span>Update</span>
                            </button>
                        </div>

                        <div>
                            <label for="" class="font-normal inline-flex items-center">
                                <input type="checkbox" name="notify_voters" id="" class="bg-gray-200 rounded" checked="">
                                <span class="ml-1">Notify All Voters</span>
                            </label>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="hidden md:flex items-center space-x-3">
            <div class="bg-white font-semibold text-center rounded-xl px-2 py-2">
                <div class="text-xl leading-snug">{{ $votesCount }}</div>
                <div class="text-gray-400 text-xs leading-none">Votes</div>
            </div>
            <button type="button" class="items-center justify-center w-32 h-11 text-xs bg-gray-200 font-semibold rounded-xl border border-gray-200 hover:border-gray-400 transition duration-150 ease-in px-6 py-3 uppercase">
                <span>Vote</span>
            </button>
        </div>
    </div>{{-- End Buttons container --}}
</div>{{-- End Idea and Buttons Container --}}
