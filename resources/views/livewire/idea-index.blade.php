<div
    x-data
    @click="
        const clicked = $event.target
        console.log($event)

        const target = clicked.tagName.toLowerCase()

        const ignores = ['button', 'svg', 'img', 'a']

        if(!ignores.includes(target)) {
            clicked.closest('.idea-container').querySelector('.idea-link').click()
        }
    "
    class="idea-container bg-white rounded-xl hover:shadow-card cursor-pointer transition duration-150 ease-in flex">
    <div class="hidden md:block border-r border-gray-100 px-5 py-8">
        <div class="text-center">
            <div class="font-semibold text-2xl @if($hasVoted) text-blue @endif">{{ $votesCount }}</div>
            <div class="text-gray-500">Votes</div>

            <div class="mt-8">
                @if ($hasVoted)
                    <button wire:click.prevent="vote" class="w-20 bg-blue border border-blue hover:bg-blue-hover text-white transition duration-150 ease-in font-bold text-xxs uppercase rounded-xl px-4 py-3">Voted</button>
                @else
                    <button wire:click.prevent="vote" class="w-20 bg-gray-200 border border-gray-200 hover:border-gray-400 transition duration-150 ease-in font-bold text-xxs uppercase rounded-xl px-4 py-3">Vote</button>
                @endif
            </div>
        </div>
    </div>
    <div class="flex flex-col md:flex-row flex-1 px-2 py-6">
        <div class="flex-none mx-2 md:mx-4">
            <a href="#">
                <img src="{{ $idea->user->getAvatar() }}" alt="avatar" class="w-14 h-14 rounded-xl">
            </a>
        </div>
        <div class="mx-2 w-full flex flex-col justify-between">
            <h4 class="text-xl font-semibold mt-2 md:mt-0">
                <a href="{{ route('idea.show', $idea) }}" class="hover:underline idea-link">{{ $idea->title }}</a>
            </h4>

            <div class="text-gray-600 mt-3 line-clamp-3">
                {{ $idea->description }}
            </div>

            <div class="flex flex-col md:flex-row md:items-center justify-between mt-6">
                <div class="flex items-center text-xs text-gray-400 font-semibold space-x-2">
                    <div>{{ $idea->created_at->diffForHumans() }}</div>
                    <div>&bull;</div>
                    <div>{{ $idea->category->name }}</div>
                    <div>&bull;</div>
                    <div class="text-gray-900">3 Comments</div>
                </div>
                <div
                    x-data="{ isOpen: false }"
                    class="flex items-center space-x-2 mt-4 md:mt-0"
                >
                    <div class="{{ $idea->status->classes }} text-xxs font-bold uppercase leading-none rounded-full text-center w-28 h-7 py-2 px-4">{{ $idea->status->name }}</div>
                    <button
                        @click="isOpen = !isOpen"
                        class="relative bg-gray-100 hover:bg-gray-200 transition duration-150 ease-in rounded-full border h-7 py-2 px-3"
                    >
                        <img class="w-7 -my-5" src="{{ asset('img/three-dots.svg') }}" alt="">
                        <ul
                            x-cloak
                            x-show.transition.origin.top.left.duration.150ms="isOpen"
                            @click.away="isOpen = false"
                            @keydown.escape.window = "isOpen = false"
                            class="absolute w-44 font-semibold bg-white shadow-dialog rounded-xl py-3 text-left md:ml-8 top-8 md:top-6 right-0 md:left-0"
                        >
                            <li><a href="#" class="hover:bg-gray-100 block transition duration-150 ease-in px-5 py-3">Mark As Spam</a></li>
                            <li><a href="#" class="hover:bg-gray-100 block transition duration-150 ease-in px-5 py-3">Delete Post</a></li>
                        </ul>
                    </button>
                </div>
            </div>
            <div class="flex items-center md:hidden mt-4 md:mt-0 md">
                <div class="bg-gray-100 text-center-rounded-xl h-10 px-4 py-2 pr-8">
                    <div class="text-sm font-bold leading-none @if($hasVoted) text-blue @endif">{{ $votesCount }}</div>
                    <div class="text-xxs leading-none font-semibold text-gray-400 uppercase">Votes</div>
                </div>
                @if ($hasVoted)
                    <button wire:click.prevent='vote' class="w-20 bg-blue font-bold text-xxs text-white uppercase rounded-xl hover:bg-blue-hover transition duration-150 ease-in px-4 py-3 -mx-5">Voted</button>
                @else
                    <button wire:click.prevent='vote' class="w-20 bg-gray-200 font-bold text-xxs uppercase rounded-xl hover:border-gray-400 transition duration-150 ease-in px-4 py-3 -mx-5">Vote</button>
                @endif
            </div>
        </div>

    </div>
</div> {{-- End Idea Container --}}
