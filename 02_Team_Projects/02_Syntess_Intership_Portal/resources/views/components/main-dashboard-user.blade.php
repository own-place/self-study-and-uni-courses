<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{__('Generic dashboard template')}}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Indie+Flower&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

    {{-- Ensure Tailwind CSS is linked here --}}
    @stack('scripts')
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
{{-- Tailwind component - https://flowbite.com/docs/components/sidebar/ --}}


<nav class="fixed top-0 z-50 w-full bg-white border-b border-gray-200 dark:bg-gray-800 dark:border-gray-700">
    <div class="px-3 py-3 lg:px-5 lg:pl-3">
        <div class="flex items-center justify-between">
            <div class="flex items-center justify-start rtl:justify-end">
                <button data-drawer-target="logo-sidebar" data-drawer-toggle="logo-sidebar" aria-controls="logo-sidebar"
                        type="button"
                        class="inline-flex items-center p-2 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
                    <span class="sr-only">{{__('Open sidebar')}}</span>
                    <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                         xmlns="http://www.w3.org/2000/svg">
                        <path clip-rule="evenodd" fill-rule="evenodd"
                              d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z"></path>
                    </svg>
                </button>
                <a href="{{route('redirectBasedOnRole')}}" class="flex ms-2 md:me-24">
                    <img src="{{asset('images/COMPANY_logo_syntess.png')}}" class="h-8 me-3" alt="Syntess Logo"/>
                </a>
            </div>
            <div class="flex items-center">
                <div class="flex items-center ms-3">
                    <div class="hidden sm:flex sm:items-center sm:ms-6">
                        <div
                            class="flex text-sm bg-gray-800 rounded-full focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600">
                            <img class="w-8 h-8 rounded-full" alt="user photo"
                                 src="{{ Auth::user()->photo ? Storage::url(Auth::user()->photo) : 'https://flowbite.com/docs/images/people/profile-picture-5.jpg' }}">
                        </div>
                    </div>
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button
                                class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                                <div>{{ Auth::user()->full_name }}</div>

                                <div class="ms-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                         viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                              d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                              clip-rule="evenodd"/>
                                    </svg>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link :href="route('profile.edit')">
                                {{ __('Profile') }}
                            </x-dropdown-link>

                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <x-dropdown-link :href="route('logout')"
                                                 onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                    <div class="relative">
                        <button id="notificationDropdownButton" class="relative">
                            <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="20" height="20"
                                 viewBox="0 0 48 48">
                                <path
                                    d="M 23.277344 4.0175781 C 15.193866 4.3983176 9 11.343391 9 19.380859 L 9 26.648438 L 6.3496094 31.980469 A 1.50015 1.50015 0 0 0 6.3359375 32.009766 C 5.2696804 34.277268 6.9957076 37 9.5019531 37 L 18 37 C 18 40.295865 20.704135 43 24 43 C 27.295865 43 30 40.295865 30 37 L 38.496094 37 C 41.002339 37 42.730582 34.277829 41.664062 32.009766 A 1.50015 1.50015 0 0 0 41.650391 31.980469 L 39 26.648438 L 39 19 C 39 10.493798 31.863289 3.6133643 23.277344 4.0175781 z M 23.417969 7.0136719 C 30.338024 6.6878857 36 12.162202 36 19 L 36 27 A 1.50015 1.50015 0 0 0 36.15625 27.667969 L 38.949219 33.289062 C 39.128826 33.674017 38.921017 34 38.496094 34 L 9.5019531 34 C 9.077027 34 8.8709034 33.674574 9.0507812 33.289062 C 9.0507812 33.289062 9.0507812 33.287109 9.0507812 33.287109 L 11.84375 27.667969 A 1.50015 1.50015 0 0 0 12 27 L 12 19.380859 C 12 12.880328 16.979446 7.3169324 23.417969 7.0136719 z M 21 37 L 27 37 C 27 38.674135 25.674135 40 24 40 C 22.325865 40 21 38.674135 21 37 z"></path>
                            </svg>
                            @if(Auth::user()->unreadNotifications->count())
                                <span
                                    class="absolute top-0 right-0 block h-2.5 w-2.5 rounded-full ring-2 ring-white bg-red-600"></span>
                            @endif
                        </button>
                        <div id="notificationDropdown"
                             class="hidden absolute right-0 mt-2 w-64 bg-white rounded-lg shadow-lg z-50">
                            <div class="py-2">
                                @forelse (Auth::user()->unreadNotifications as $notification)
                                    @if(isset($notification->data['message']))
                                        <x-notification-item
                                            :message="$notification->data['message']"
                                            :id="$notification->id"
                                        />
                                    @elseif(isset($notification->data->message))
                                        <p class="px-4 py-2 text-gray-500">{{ $notification->data->message }}</p>
                                    @else
                                        <p class="px-4 py-2 text-gray-500">No message available</p>
                                    @endif
                                @empty
                                    <p class="px-4 py-2 text-gray-500">No new notifications</p>
                                @endforelse
                            </div>
                        </div>
                    </div>

                </div>

                <div class="-me-2 flex items-center sm:hidden">
                    <button @click="open = ! open"
                            class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-900 focus:text-gray-500 dark:focus:text-gray-400 transition duration-150 ease-in-out">
                        <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                            <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex"
                                  stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M4 6h16M4 12h16M4 18h16"/>
                            <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden"
                                  stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>

            </div>
        </div>
    </div>
</nav>

<aside id="logo-sidebar"
       class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform -translate-x-full bg-white border-r border-gray-200 sm:translate-x-0 dark:bg-gray-800 dark:border-gray-700"
       aria-label="Sidebar">
    <div class="h-full px-3 pb-4 overflow-y-auto bg-white dark:bg-gray-800">
        <ul class="space-y-2 font-medium">
            <li>
                <a href="{{route('redirectBasedOnRole')}}"
                   class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                    <svg
                        class="w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"
                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 21">
                        <path
                            d="M16.975 11H10V4.025a1 1 0 0 0-1.066-.998 8.5 8.5 0 1 0 9.039 9.039.999.999 0 0 0-1-1.066h.002Z"/>
                        <path
                            d="M12.5 0c-.157 0-.311.01-.565.027A1 1 0 0 0 11 1.02V10h8.975a1 1 0 0 0 1-.935c.013-.188.028-.374.028-.565A8.51 8.51 0 0 0 12.5 0Z"/>
                    </svg>
                    <span class="ms-3">Dashboard</span>
                </a>
            </li>
            <li>
                @can('isAdmin', \App\Models\User::class)
                    <a href="{{route('dashboards.mentor.list')}}"
                       class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                        <svg id="Teacher_24"
                             class="w-6 h-6 text-gray-500 hover:text-gray-900 transition-colors duration-200 ease-in-out"
                             viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"
                             xmlns:xlink="http://www.w3.org/1999/xlink">
                            <rect width="24" height="24" stroke="none" fill="currentColor" opacity="0"/>
                            <g transform="matrix(1 0 0 1 12 12)">
                                <path
                                    style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-dashoffset: 0; stroke-linejoin: miter; stroke-miterlimit: 4; fill: currentColor; fill-rule: nonzero; opacity: 1;"
                                    transform="translate(-11, -12)"
                                    d="M 4 2 C 2.895430500338413 2 2 2.895430500338413 2 4 C 2 5.1045694996615865 2.895430500338413 6 4 6 C 5.1045694996615865 6 6 5.1045694996615865 6 4 C 6 2.895430500338413 5.1045694996615865 2 4 2 z M 8 3 L 8 5 L 18 5 L 18 14 L 16 14 L 16 12 L 12 12 L 12 14 L 9 14 L 9 16 L 21 16 L 21 14 L 20 14 L 20 4.5 C 20 3.67 19.33 3 18.5 3 L 8 3 z M 3 7 C 1.89 7 1 7.89 1 9 L 1 16 L 1 22 L 3 22 L 3 16 L 5 16 L 5 22 L 7 22 L 7 16 L 7 9 L 13 9 L 13 7 L 3 7 z"
                                    stroke-linecap="round"/>
                            </g>
                        </svg>
                        <span class="ms-3">Mentors</span>
                    </a>
                    <a href="{{route('dashboards.intern.list')}}"
                       class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                        <svg id='Working_With_a_Laptop_24'
                             class="w-6 h-6 text-gray-500 hover:text-gray-900 transition-colors duration-200 ease-in-out"
                             viewBox='0 0 24 24' xmlns='http://www.w3.org/2000/svg'
                             xmlns:xlink='http://www.w3.org/1999/xlink'>
                            <rect width='24' height='24' stroke='none' fill='currentColor' opacity='0'/>
                            <g transform="matrix(1.11 0 0 1.11 12 12)">
                                <path style="stroke: none; stroke-width: 1; fill: currentColor;"
                                      transform=" translate(-12, -12)"
                                      d="M 12 3 C 9.8027056 3 8 4.8027056 8 7 C 8 8.1971294 8.5462008 9.264839 9.3886719 10 L 4 10 L 4.8183594 19 L 3 19 L 3 21 L 5 21 L 19 21 L 21 21 L 21 19 L 19.181641 19 L 20 10 L 14.611328 10 C 15.453799 9.264839 16 8.1971294 16 7 C 16 4.8027056 14.197294 3 12 3 z M 12 5 C 13.116414 5 14 5.8835859 14 7 C 14 8.1164141 13.116414 9 12 9 C 10.883586 9 10 8.1164141 10 7 C 10 5.8835859 10.883586 5 12 5 z M 12 13 C 12.552 13 13 13.448 13 14 C 13 14.552 12.552 15 12 15 C 11.448 15 11 14.552 11 14 C 11 13.448 11.448 13 12 13 z"
                                      stroke-linecap="round"/>
                            </g>
                        </svg>
                        <span class="ms-3">Interns</span>
                    </a>
                    <a href="{{route('dashboards.candidate.list')}}"
                       class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                        <svg id='People_24'
                             class="w-6 h-6 text-gray-500 hover:text-gray-900 transition-colors duration-200 ease-in-out"
                             viewBox='0 0 24 24' xmlns='http://www.w3.org/2000/svg'
                             xmlns:xlink='http://www.w3.org/1999/xlink'>
                            <rect width='24' height='24' stroke='none' fill='currentColor' opacity='0'/>
                            <g transform="matrix(0.67 0 0 0.67 12 12)">
                                <path style="stroke: none; stroke-width: 1; fill: currentColor;"
                                      transform=" translate(-15, -15)"
                                      d="M 6.6015625 3 C 5.6875625 3 5 4 5 4 C -0.235 4 2.6532344 12.355891 1.1152344 13.587891 C 1.1152344 13.587891 2.058 14.753906 5 14.753906 L 5 15.751953 C 4.187 17.869953 -2.9605947e-16 17.087 0 21 L 8.0234375 21 C 8.7274375 20.574 11 19.392578 11 19.392578 C 10.457 18.812578 9.6736719 17.809781 9.3886719 17.050781 C 8.7646719 16.737781 8.237 16.369953 8 15.751953 L 8 14.742188 C 8.19 14.742188 8.7502656 14.698297 8.9472656 14.654297 C 8.5012656 13.967297 8.125 12.401438 8.125 11.523438 C 8.125 9.2904375 9.0866406 7.4537344 10.681641 6.3027344 C 10.200641 4.4617344 9.1325625 3 6.6015625 3 z M 23 3 C 20.777 3 19.412031 4.5292031 19.082031 6.5332031 C 20.698031 7.3992031 21.75 9.2661875 21.75 11.617188 C 21.75 12.352187 21.578578 13.059422 21.392578 13.607422 C 21.461578 13.878422 21.5 14.180625 21.5 14.515625 C 21.5 16.985625 19 19.449219 19 19.449219 C 19.543 19.686219 21.280234 20.569 21.990234 21 L 30 21 C 30 15.75 25.737 17.25 25 15 L 25 13.5 C 25.332 13.333 26.122656 12.183156 26.222656 11.285156 C 26.482656 11.265156 27 10.629547 27 10.060547 C 27 9.4915469 26.819109 9.2521562 26.662109 9.1601562 C 26.662109 9.1601562 27 8.409 27 7.5 C 27 5.679 26.508 4 25 4 C 25 4 24.567 3 23 3 z M 15 7 C 12.308 7 10.125 8.6214375 10.125 11.523438 C 10.125 12.750438 10.8125 13.707031 10.8125 13.707031 C 10.8125 13.707031 10.5 13.860625 10.5 14.515625 C 10.5 15.788625 11.318359 16.09375 11.318359 16.09375 C 11.432359 17.10175 13 18.578125 13 18.578125 L 13 20.263672 C 12.158 22.789672 7 21.125 7 27 L 23 27 C 23 21.105 17.842 22.789672 17 20.263672 L 17 18.578125 C 17 18.578125 18.567641 17.10175 18.681641 16.09375 C 18.681641 16.09375 19.5 15.528625 19.5 14.515625 C 19.5 13.813625 19.1875 13.707031 19.1875 13.707031 C 19.1875 13.707031 19.75 12.637188 19.75 11.617188 C 19.75 9.5721875 18.724 8 17 8 C 17 8 16.268 7 15 7 z"
                                      stroke-linecap="round"/>
                            </g>
                        </svg>
                        <span class="ms-3">Candidates</span>
                    </a>
                    <a href="{{ route('admin.internships.index') }}"
                       class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                        <svg id='Internship_24'
                             class="w-6 h-6 text-gray-500 hover:text-gray-900 transition-colors duration-200 ease-in-out"
                             viewBox='0 0 24 24' xmlns='http://www.w3.org/2000/svg'
                             xmlns:xlink='http://www.w3.org/1999/xlink'>
                            <rect width='24' height='24' stroke='none' fill='currentColor' opacity='0'/>
                            <g transform="matrix(0.4 0 0 0.4 12 12)">
                                <path style="stroke: none; stroke-width: 1; fill: currentColor;"
                                      transform=" translate(-25, -26.5)"
                                      d="M 16 3 C 14.393643 3 13 4.2498754 13 5.8574219 L 13 8 L 2.6679688 8 C 1.2246382 8 -2.9605947e-16 9.1632758 0 10.611328 L 0 24.142578 L 0 36.388672 C 0 37.836724 1.2246383 39 2.6679688 39 L 11.5 39 L 11.5 42.142578 C 11.5 43.749125 12.893643 45 14.5 45 L 33.5 45 C 35.106357 45 36.5 43.750125 36.5 42.142578 L 36.5 39 L 45.332031 39 C 46.775362 39 48 37.836724 48 36.388672 L 48 24.142578 L 48 10.611328 C 48 9.1632758 46.775362 8 45.332031 8 L 35 8 L 35 5.8574219 C 35 4.2498754 33.606357 3 32 3 L 16 3 z M 16 5 L 32 5 C 32.541643 5 33 5.4571246 33 5.8574219 L 33 8 L 15 8 L 15 5.8574219 C 15 5.4571246 15.458357 5 16 5 z M 2.6679688 10 L 45.332031 10 C 45.79284 10 46 10.20616 46 10.667969 L 46 14 L 2 14 L 2 10.667969 C 2 10.20616 2.2080973 10 2.6679688 10 z M 24 19 L 24 27 C 22.930326 27 22 27.930326 22 29 C 22 30.069674 22.930326 31 24 31 C 25.069674 31 26 30.069674 26 29 C 26 27.930326 25.069674 27 24 27 L 24 19 z M 2 16 L 46 16 L 46 24 L 42.5 24 L 42.5 28 C 42.5 28.54075 42.04225 29 41.5 29 C 40.95775 29 40.5 28.54075 40.5 28 L 40.5 24 L 7.5 24 L 7.5 28 C 7.5 28.54075 7.04225 29 6.5 29 C 5.95775 29 5.5 28.54075 5.5 28 L 5.5 24 L 2 24 L 2 16 z M 2 26.5 L 5 26.5 L 5 29.5 C 5 30.87725 6.12275 32 7.5 32 C 8.87725 32 10 30.87725 10 29.5 L 10 26.5 L 38 26.5 L 38 29.5 C 38 30.87725 39.12275 32 40.5 32 C 41.87725 32 43 30.87725 43 29.5 L 43 26.5 L 46 26.5 L 46 36.388672 C 46 36.793276 45.759362 37 45.332031 37 L 2.6679688 37 C 2.2406383 37 2 36.793276 2 36.388672 L 2 26.5 z M 13.5 41 L 35.5 41 C 35.958357 41 36.5 41.457875 36.5 41.857422 L 36.5 42.142578 C 36.5 42.542125 35.957643 43 35.5 43 L 13.5 43 C 13.041643 43 12.5 42.542125 12.5 42.142578 L 12.5 41.857422 C 12.5 41.457875 13.041643 41 13.5 41 z"
                                      stroke-linecap="round"/>
                            </g>
                        </svg>
                        <span class="ms-3">Internships</span>
                    </a>
                    <a href="{{route('admin.statistics')}}"
                       class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                        <svg id='Graph_Stats_Ascend_24' width='24' height='24' viewBox='0 0 24 24'
                             xmlns='http://www.w3.org/2000/svg' xmlns:xlink='http://www.w3.org/1999/xlink'>
                            <rect width='24' height='24' stroke='none' fill='#000000' opacity='0'/>
                            <g transform="matrix(1.01 0 0 1.01 12 12)">
                                <path
                                    class="fill-current text-gray-400 hover:text-gray-900 transition-colors duration-300"
                                    transform="translate(-11.15, -12.85)"
                                    d="M 14 7 L 14 9 L 17.586 9 L 12 14.586 L 8 10.586 L 1.2930000000000001 17.293 L 2.707 18.707 L 8 13.414 L 12 17.414 L 19 10.414000000000001 L 19 14 L 21 14 L 21 7 L 14 7 z"
                                    stroke-linecap="round"/>
                            </g>
                        </svg>
                        <span class="ms-3">Statistics</span>
                    </a>
                @endcan
            </li>

            <li>
                @can('isMentor', \App\Models\User::class)
                    <a href="{{route('dashboards.candidates')}}"
                       class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                        <svg
                            class="w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"
                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                            viewBox="0 0 22 21">
                            <path
                                d="M16.975 11H10V4.025a1 1 0 0 0-1.066-.998 8.5 8.5 0 1 0 9.039 9.039.999.999 0 0 0-1-1.066h.002Z"/>
                            <path
                                d="M12.5 0c-.157 0-.311.01-.565.027A1 1 0 0 0 11 1.02V10h8.975a1 1 0 0 0 1-.935c.013-.188.028-.374.028-.565A8.51 8.51 0 0 0 12.5 0Z"/>
                        </svg>
                        <span class="ms-3">Candidate Applications</span>
                    </a>
                    <a href="{{route('mentor.hub')}}"
                       class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                        <svg
                            class="w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"
                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                            viewBox="0 0 22 21">
                            <path
                                d="M16.975 11H10V4.025a1 1 0 0 0-1.066-.998 8.5 8.5 0 1 0 9.039 9.039.999.999 0 0 0-1-1.066h.002Z"/>
                            <path
                                d="M12.5 0c-.157 0-.311.01-.565.027A1 1 0 0 0 11 1.02V10h8.975a1 1 0 0 0 1-.935c.013-.188.028-.374.028-.565A8.51 8.51 0 0 0 12.5 0Z"/>
                        </svg>
                        <span class="ms-3">Mentor HUB</span>
                    </a>
                @endcan
            </li>
            <li>
                @can('isIntern', \App\Models\User::class)

                @endcan
            </li>
            <li>
                @can('isHr', \App\Models\User::class)
                    <a href="{{ route('hr.applications.dashboard') }}"
                       class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                        <svg id='Internship_24'
                             class="w-6 h-6 text-gray-500 hover:text-gray-900 transition-colors duration-200 ease-in-out"
                             viewBox='0 0 24 24' xmlns='http://www.w3.org/2000/svg'
                             xmlns:xlink='http://www.w3.org/1999/xlink'>
                            <rect width='24' height='24' stroke='none' fill='currentColor' opacity='0'/>
                            <g transform="matrix(0.4 0 0 0.4 12 12)">
                                <path style="stroke: none; stroke-width: 1; fill: currentColor;"
                                      transform=" translate(-25, -26.5)"
                                      d="M 16 3 C 14.393643 3 13 4.2498754 13 5.8574219 L 13 8 L 2.6679688 8 C 1.2246382 8 -2.9605947e-16 9.1632758 0 10.611328 L 0 24.142578 L 0 36.388672 C 0 37.836724 1.2246383 39 2.6679688 39 L 11.5 39 L 11.5 42.142578 C 11.5 43.749125 12.893643 45 14.5 45 L 33.5 45 C 35.106357 45 36.5 43.750125 36.5 42.142578 L 36.5 39 L 45.332031 39 C 46.775362 39 48 37.836724 48 36.388672 L 48 24.142578 L 48 10.611328 C 48 9.1632758 46.775362 8 45.332031 8 L 35 8 L 35 5.8574219 C 35 4.2498754 33.606357 3 32 3 L 16 3 z M 16 5 L 32 5 C 32.541643 5 33 5.4571246 33 5.8574219 L 33 8 L 15 8 L 15 5.8574219 C 15 5.4571246 15.458357 5 16 5 z M 2.6679688 10 L 45.332031 10 C 45.79284 10 46 10.20616 46 10.667969 L 46 14 L 2 14 L 2 10.667969 C 2 10.20616 2.2080973 10 2.6679688 10 z M 24 19 L 24 27 C 22.930326 27 22 27.930326 22 29 C 22 30.069674 22.930326 31 24 31 C 25.069674 31 26 30.069674 26 29 C 26 27.930326 25.069674 27 24 27 L 24 19 z M 2 16 L 46 16 L 46 24 L 42.5 24 L 42.5 28 C 42.5 28.54075 42.04225 29 41.5 29 C 40.95775 29 40.5 28.54075 40.5 28 L 40.5 24 L 7.5 24 L 7.5 28 C 7.5 28.54075 7.04225 29 6.5 29 C 5.95775 29 5.5 28.54075 5.5 28 L 5.5 24 L 2 24 L 2 16 z M 2 26.5 L 5 26.5 L 5 29.5 C 5 30.87725 6.12275 32 7.5 32 C 8.87725 32 10 30.87725 10 29.5 L 10 26.5 L 38 26.5 L 38 29.5 C 38 30.87725 39.12275 32 40.5 32 C 41.87725 32 43 30.87725 43 29.5 L 43 26.5 L 46 26.5 L 46 36.388672 C 46 36.793276 45.759362 37 45.332031 37 L 2.6679688 37 C 2.2406383 37 2 36.793276 2 36.388672 L 2 26.5 z M 13.5 41 L 35.5 41 C 35.958357 41 36.5 41.457875 36.5 41.857422 L 36.5 42.142578 C 36.5 42.542125 35.957643 43 35.5 43 L 13.5 43 C 13.041643 43 12.5 42.542125 12.5 42.142578 L 12.5 41.857422 C 12.5 41.457875 13.041643 41 13.5 41 z"
                                      stroke-linecap="round"/>
                            </g>
                        </svg>
                        <span class="ms-3">Applications</span>
                    </a>
                @endcan
            </li>
            <li>
                <a href="{{route('profile.edit')}}"
                   class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                    <svg xmlns="http://www.w3.org/2000/svg"
                         class="w-5 h-5 text-gray-500 transition duration-75 group-hover:text-gray-900"
                         viewBox="0 0 50 50" fill="currentColor">
                        <path
                            d="M47.16,21.221l-5.91-0.966c-0.346-1.186-0.819-2.326-1.411-3.405l3.45-4.917c0.279-0.397,0.231-0.938-0.112-1.282 l-3.889-3.887c-0.347-0.346-0.893-0.391-1.291-0.104l-4.843,3.481c-1.089-0.602-2.239-1.08-3.432-1.427l-1.031-5.886 C28.607,2.35,28.192,2,27.706,2h-5.5c-0.49,0-0.908,0.355-0.987,0.839l-0.956,5.854c-1.2,0.345-2.352,0.818-3.437,1.412l-4.83-3.45 c-0.399-0.285-0.942-0.239-1.289,0.106L6.82,10.648c-0.343,0.343-0.391,0.883-0.112,1.28l3.399,4.863 c-0.605,1.095-1.087,2.254-1.438,3.46l-5.831,0.971c-0.482,0.08-0.836,0.498-0.836,0.986v5.5c0,0.485,0.348,0.9,0.825,0.985 l5.831,1.034c0.349,1.203,0.831,2.362,1.438,3.46l-3.441,4.813c-0.284,0.397-0.239,0.942,0.106,1.289l3.888,3.891 c0.343,0.343,0.884,0.391,1.281,0.112l4.87-3.411c1.093,0.601,2.248,1.078,3.445,1.424l0.976,5.861C21.3,47.647,21.717,48,22.206,48 h5.5c0.485,0,0.9-0.348,0.984-0.825l1.045-5.89c1.199-0.353,2.348-0.833,3.43-1.435l4.905,3.441 c0.398,0.281,0.938,0.232,1.282-0.111l3.888-3.891c0.346-0.347,0.391-0.894,0.104-1.292l-3.498-4.857 c0.593-1.08,1.064-2.222,1.407-3.408l5.918-1.039c0.479-0.084,0.827-0.5,0.827-0.985v-5.5C47.999,21.718,47.644,21.3,47.16,21.221z M25,32c-3.866,0-7-3.134-7-7c0-3.866,3.134-7,7-7s7,3.134,7,7C32,28.866,28.866,32,25,32z"></path>
                    </svg>
                    <span class="ms-3">Settings</span>
                </a>
            </li>
        </ul>
    </div>
</aside>
{{$slot}}
<script>
    document.getElementById('notificationDropdownButton').addEventListener('click', function () {
        var dropdown = document.getElementById('notificationDropdown');
        dropdown.classList.toggle('hidden');
    });
</script>
</body>
</html>
