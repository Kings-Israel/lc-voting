<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Laracasts Voting</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
        <style>
            .gradient-style {
                border-image-source: linear-gradient(to bottom, rgba(50, 138, 241, 0.22), rgba(99, 123, 255, 0));
                border-image-slice: 1;
                background-image: linear-gradient(to bottom, #ffffff, #ffffff), linear-gradient(to bottom, rgba(50, 138, 241, 0.22), rgba(99, 123, 255, 0));
                background-origin: border-box;
                background-clip: content-box, border-box
            }
        </style>
        @livewireStyles
    </head>
    <body class="font-sans bg-gray-background text-gray-900 text-sm">
        <header class="flex flex-col md:flex-row items-center justify-between px-8 py-4">
            <a href="#"><img src="{{ asset('img/laracasts.svg') }}" alt=""></a>
            <div class="flex items-center mt-2 md:mt-0">
                @if (Route::has('login'))
                    <div class="top-0 right-0 px-6 py-4">
                        @auth
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <a href="{{route('logout')}}"
                                        onclick="event.preventDefault();
                                                    this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </a>
                            </form>
                        @else
                            <a href="{{ route('login') }}" class="text-sm text-gray-700 underline">Log in</a>

                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 underline">Register</a>
                            @endif
                        @endauth
                    </div>
                @endif
                <a href="#">
                    <img src="https://www.gravatar.com/avatar/000000000000000000000?d=mp" alt="avatar" class="w-10 h-10 rounded-full">
                </a>
            </div>
        </header>

        <main class="container mx-auto max-w-custom flex flex-col md:flex-row">
            <div class="w-70 mx-auto md:mx-0 md:mr-5">
                <div class="bg-white border-2 border-blue rounded-xl mt-16 gradient-style md:sticky md:top-8">
                    <div class="text-center px-6 py-2 pt-6">
                        <h3 class="font-semibold text-base">Add an Idea</h3>
                        <p class="text-xs mt-4">Let Us Know what you would like and we'll take a look</p>
                    </div>
                    <form action="" method="POST" class="space-y-4 px-4 py-6">
                        <div>
                            <input type="text" class="w-full bg-gray-100 text-sm rounded-xl placeholder-gray-900 border-none" placeholder="Your Idea">
                        </div>
                        <div>
                            <select name="category_add" id="category_add" class="bg-gray-100 w-full rounded-xl px-4 py-2 border-none text-sm">
                                <option value="Filter One" id="">Filter One</option>
                                <option value="Filter Two" id="">Filter Two</option>
                                <option value="Filter Three" id="">Filter Three</option>
                                <option value="Filter Four" id="">Filter Four</option>
                            </select>
                        </div>
                        <div>
                            <textarea name="idea" id="idea" cols="30" rows="4" class="w-full bg-gray-100 rounded-xl placeholder-gray-900 px-4 py-2 border-none text-sm" placeholder="Describe your idea"></textarea>
                        </div>
                        <div class="flex items-center justify-between space-x-3">
                            <button type="button" class="flex items-center justify-center w-1/2 h-11 text-xs bg-gray-200 font-semibold rounded-xl border border-gray-200 hover:border-gray-400 transition duration-150 ease-in px-6 py-3">
                                <svg class="text-gray-600 w-4 transform -rotate-45" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13" />
                                  </svg>
                                <span class="ml-1">Attach</span>
                            </button>
                            <button type="submit" class="bg-blue flex items-center justify-center w-1/2 h-11 text-xs bg-gray-200 font-semibold rounded-xl border border-blue hover:bg-blue-hover transition duration-150 ease-in px-6 py-3 text-white">
                                <span>Submit</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="w-full px-2 md:px-0 md:w-175">
                <nav class="hidden md:flex items-center justify-between text-xs">
                    <ul class="flex uppercase font-semibold space-x-10 border-b-4 pb-3">
                        <li><a href="" class="border-b-4 pb-3 border-blue">All Ideas (67)</a></li>
                        <li><a href="" class="text-gray-400 transition diration-150 ease-in border-b-4 pb-3 hover:border-blue">Considering (7)</a></li>
                        <li><a href="" class="text-gray-400 transition duration-150 ease-in border-b-4 pb-3 hover:border-blue">In Progress (9)</a></li>
                    </ul>

                    <ul class="flex uppercase font-semibold space-x-10 border-b-4 pb-3">
                        <li><a href="" class="text-gray-400 transition duration-150 ease-in border-b-4 pb-3 hover:border-blue">Implemented (10)</a></li>
                        <li><a href="" class="text-gray-400 transition duration-150 ease-in border-b-4 pb-3 hover:border-blue">Closed (8)</a></li>
                    </ul>
                </nav>
                <div class="mt-8">
                    {{ $slot }}
                </div>
            </div>
        </main>
        @livewireScripts
    </body>
</html>