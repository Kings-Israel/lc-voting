<div class="idea-and-buttons-container">
    <div class="idea-container bg-white rounded-xl mt-1 flex">
        <div class="flex flex-col md:flex-row flex-1 px-4 py-6">
            <div class="flex-none mx-2 md:mx-0">
                <a href="#">
                    <img src="{{ $idea->user->getAvatar() }}" alt="avatar" class="w-14 h-14 rounded-xl">
                </a>
            </div>
            <div class="mx-2 w-full">
                <h4 class="text-xl font-semibold mt-2 md:mt-0">
                    {{ $idea->title }}
                </h4>

                @admin
                    @if ($idea->spam_reports > 0)
                        <div class="text-red mb-2">Spam Reports: {{ $idea->spam_reports }}</div>
                    @endif
                @endadmin

                <div class="text-gray-600 mt-3">
                    {!! nl2br(e($idea->description)) !!}
                </div>

                <div class="flex flex-col md:flex-row md:items-center justify-between mt-6">
                    <div class="flex md:items-center text-xs text-gray-400 font-semibold md:space-x-2">
                        <div class="font-bold text-gray-900 hidden md:block">{{ $idea->user->name }}</div>
                        <div class="hidden md:block">&bull;</div>
                        <div>{{ $idea->created_at->diffForHumans() }}</div>
                        <div>&bull;</div>
                        <div>{{ $idea->category->name }}</div>
                        <div>&bull;</div>
                        <div class="text-gray-900">{{ $idea->comments()->count() }} comments</div>
                    </div>
                    <div class="flex mt-4 md:mt-0 items-center space-x-2" x-data="{ isOpen: false }">
                        <div class="{{ 'status-'.Str::kebab($idea->status->name) }} text-xxs font-bold uppercase leading-none rounded-full text-center w-28 h-7 py-2 px-4">{{ $idea->status->name }}</div>
                        @auth
                            <div class="relative">
                                <button class="bg-gray-100 hover:bg-gray-200 transition duration-150 ease-in rounded-full border h-7 py-2 px-3" @click="isOpen = !isOpen">
                                    <img class="w-7 -my-5" src="{{ asset('img/three-dots.svg') }}" alt="">
                                </button>
                                <ul
                                    x-cloak
                                    x-show.transition.origin.top.left.duration.150ms="isOpen"
                                    @click.away="isOpen = false"
                                    @keydown.escape.window = "isOpen = false"
                                    class="absolute w-44 font-semibold bg-white shadow-dialog rounded-xl py-3 text-left z-10 md:ml-8 top-8 md:top-6 right-0 md:left-0">
                                    @can('update', $idea)
                                        <li>
                                            <a
                                                @click.prevent="
                                                    isOpen = false
                                                    $dispatch('custom-show-edit-modal')
                                                "
                                                href="#"
                                                class="hover:bg-gray-100 block transition duration-150 ease-in px-5 py-3">
                                                Edit Idea
                                            </a>
                                        </li>
                                    @endcan

                                    @can('delete', $idea)
                                        <li>
                                            <a
                                                @click.prevent="
                                                    isOpen = false
                                                    $dispatch('custom-show-delete-idea-modal')
                                                "
                                                href="#"
                                                class="hover:bg-gray-100 block transition duration-150 ease-in px-5 py-3">
                                                Delete Idea
                                            </a>
                                        </li>
                                    @endcan
                                    <li>
                                        <a
                                            @click.prevent="
                                                isOpen = false
                                                $dispatch('custom-show-mark-idea-as-spam-modal')
                                            "
                                            href="#"
                                            class="hover:bg-gray-100 block transition duration-150 ease-in px-5 py-3">
                                            Mark As Spam
                                        </a>
                                    </li>

                                    @if ($idea->spam_reports > 0)
                                        <li>
                                            <a
                                                @click.prevent="
                                                    isOpen = false
                                                    $dispatch('custom-show-mark-idea-as-not-spam-modal')
                                                "
                                                href="#"
                                                class="hover:bg-gray-100 block transition duration-150 ease-in px-5 py-3">
                                                Mark As NOT Spam
                                            </a>
                                        </li>
                                    @endif
                                </ul>
                            </div>
                        @endauth
                    </div>

                    <div class="flex items-center md:hidden mt-4 md:mt-0 md">
                        <div class="bg-gray-100 text-center-rounded-xl h-10 px-4 py-2 pr-8">
                            <div class="text-sm font-bold leading-none @if($hasVoted) text-blue @endif">{{ $votesCount }}</div>
                            <div class="text-xxs leading-none font-semibold text-gray-400 uppercase">Votes</div>
                        </div>
                        @if ($hasVoted)
                            <button wire:click.prevent="vote" class="w-20 bg-blue text-white font-bold text-xxs uppercase rounded-xl hover:bg-blue-hover transition duration-150 ease-in px-4 py-3 -mx-5">Voted</button>
                        @else
                            <button wire:click.prevent="vote" class="w-20 bg-gray-200 font-bold text-xxs uppercase rounded-xl hover:border-gray-400 transition duration-150 ease-in px-4 py-3 -mx-5">Vote</button>
                        @endif
                    </div>
                </div>
            </div>

        </div>
    </div> {{-- End Idea Container --}}

    <div class="button-container flex items-center justify-between">
        <div class="flex flex-col md:flex-row items-center space-x-4 md:ml-6">
            <livewire:add-comment :idea="$idea" />
            @auth
                @if (auth()->user()->isAdmin())
                    <livewire:set-status :idea='$idea' />
                @endif
            @endauth
        </div>
        <div class="hidden md:flex items-center space-x-3">
            <div class="bg-white font-semibold text-center rounded-xl px-2 py-2">
                <div class="text-xl leading-snug @if($hasVoted) text-blue @endif">{{ $votesCount }}</div>
                <div class="text-gray-400 text-xs leading-none">Votes</div>
            </div>
            @if ($hasVoted)
                <button wire:click.prevent='vote' type="button" class="items-center justify-center w-32 h-11 text-xs text-white bg-blue font-semibold rounded-xl border border-gray-200 hover:bg-blue-hover transition duration-150 ease-in px-6 py-3 uppercase">
                    <span>Voted</span>
                </button>
            @else
                <button wire:click.prevent='vote' type="button" class="items-center justify-center w-32 h-11 text-xs bg-gray-200 font-semibold rounded-xl border border-gray-200 hover:border-gray-400 transition duration-150 ease-in px-6 py-3 uppercase">
                    <span>Vote</span>
                </button>
            @endif
        </div>
    </div>{{-- End Buttons container --}}
</div>{{-- End Idea and Buttons Container --}}
