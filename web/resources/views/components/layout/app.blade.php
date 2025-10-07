<!DOCTYPE html>
<html
    class="h-full bg-gray-900"
    lang="{{ str_replace('_', '-', app()->getLocale()) }}"
>

<x-layout.head />

<body class="h-full text-white">
<nav class="bg-gray-800">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="flex h-16 items-center justify-between">
            <div class="flex items-center">
                <div class="hidden md:block">
                    <div class="ml-10 flex items-baseline space-x-4">
                        <a href="{{ route('home') }}"
                                @class([
                                   'rounded-md px-3 py-2 text-sm font-medium',
                                   'bg-gray-900 text-sm font-medium text-white' => Route::is('home'),
                                   'text-gray-300 hover:bg-white/5 hover:text-white' => !Route::is('home'),
                                ])
                        >
                            Home
                        </a>
                        <a href="{{ route('posts.index') }}"
                                @class([
                                       'rounded-md px-3 py-2 text-sm font-medium',
                                       'bg-gray-900 text-sm font-medium text-white' => Route::is('posts.index'),
                                       'text-gray-300 hover:bg-white/5 hover:text-white' => !Route::is('posts.index'),
                                    ])
                        >
                            Blog Posts
                        </a>
                        <a href="{{ route('posts.create') }}"
                                @class([
                                       'rounded-md px-3 py-2 text-sm font-medium',
                                       'bg-gray-900 text-sm font-medium text-white' => Route::is('posts.create'),
                                       'text-gray-300 hover:bg-white/5 hover:text-white' => !Route::is('posts.create'),
                                    ])
                        >
                            Create Blog Post
                        </a>
                    </div>
                </div>
            </div>
            <div class="hidden md:block">
                <div class="ml-4 flex items-center md:ml-6">
                    @if (Auth::user())
                        <!-- Profile dropdown -->
                        <x-button id="dropdownUserButton" type="button"
                                  data-dropdown-toggle="dropdownUser"
                                  data-dropdown-placement="bottom-end"
                                  class="flex justify-center items-center"
                        >
                            {{ auth()->user()->name }}
                            <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                            </svg>
                        </x-button>

                        <div id="dropdownUser" class="z-10 hidden  divide-y divide-gray-100 text-white rounded-lg shadow-sm w-44 bg-gray-700 outline-1 outline-gray-600">
                            <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownUserButton">
                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        @method('POST')
                                        <button class="block w-full px-4 py-2 text-left hover:bg-gray-600 text-white">
                                            Logout
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    @else
                        <a href="{{ route('login') }}" class="rounded-md px-3 py-2 text-sm font-medium text-gray-300 hover:bg-white/5 hover:text-white">Login</a>
                        <a href="{{ route('register') }}" class="rounded-md px-3 py-2 text-sm font-medium text-gray-300 hover:bg-white/5 hover:text-white">Register</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</nav>

@if (isset($header))
    <header class="relative bg-gray-700 shadow-sm">
        <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
            <h1 class="text-3xl font-bold tracking-tight text-white">
                {{ $header }}
            </h1>
        </div>
    </header>
@endif

<main>
    @if (session('message'))
        <div id="alert-info" class="flex max-w-7xl mx-auto items-center p-4 mb-4 mt-4 text-blue-800 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-blue-400" role="alert">
            <svg class="shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
            </svg>
            <span class="sr-only">Info</span>
            <div class="ms-3 text-sm font-medium">
                {{ session('message') }}
            </div>
            <button type="button" data-dismiss-target="#alert-info" aria-label="Close"
                    class="ms-auto -mx-1.5 -my-1.5 bg-blue-50 text-blue-500 rounded-lg focus:ring-2 focus:ring-blue-400 p-1.5 hover:bg-blue-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-blue-400 dark:hover:bg-gray-700"
            >
                <span class="sr-only">Close</span>
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                </svg>
            </button>
        </div>
    @endif
    <div class="mx-auto my-4 max-w-7xl px-4 py-6 sm:px-6 lg:px-8 bg-gray-800 rounded-2xl shadow-2xl">
        {{ $slot }}
    </div>
</main>
</body>
</html>


