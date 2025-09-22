<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Generic information</title>

    {{-- Ensure Tailwind CSS is linked here --}}
    @vite(['resources/css/app.css'])
</head>
<body>
@if(\Illuminate\Support\Facades\Auth::user() && !\Illuminate\Support\Facades\Auth::user()->application)
    <x-main-dashboard-user>
        <div class="p-4 sm:ml-64 flex mt-10 flex-wrap">
            {{$slot}}
        </div>
    </x-main-dashboard-user>
@else

    {{-- Tailwind component - https://tailwindui.com/components/application-ui/navigation/navbars --}}
    <nav class="text-black sticky top-0 bg-white z-20">
        <div class="mx-auto max-w-7xl px-2 sm:px-6 lg:px-8">
            <div class="relative flex h-16 items-center justify-between">
                <div class="absolute inset-y-0 left-0 flex items-center sm:hidden">


                    <!-- Mobile menu button-->
                    <button type="button"
                            class=" transition-all duration-500 ease-in relative inline-flex items-center justify-center rounded-md p-2 text-gray-400 hover:bg-gray-700 hover:text-white focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white"
                            aria-controls="mobile-menu" aria-expanded="false" id="burger">
                        <span class="absolute -inset-0.5"></span>
                        <span class="sr-only">{{__('Open main menu')}}</span>
                        <!-- Icon when menu is closed. Menu open: "hidden", Menu closed: "block" -->
                        <svg class="block h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                             stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5"/>
                        </svg>
                        <!-- Icon when menu is open. Menu open: "block", Menu closed: "hidden" -->
                        <svg class="hidden h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                             stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>

                </div>
                <div class="flex flex-1 items-center justify-center sm:items-stretch sm:justify-start">
                    <div class="flex flex-shrink-0 items-center">
                        <a href="{{route('welcome')}}"><img class="h-8 w-auto"
                                                            src="{{asset('images/COMPANY_logo_syntess.png')}}"
                                                            alt="Syntess"></a>
                    </div>
                    <div class="hidden sm:ml-6 sm:block">
                        <div class="flex space-x-4">
                            <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
                            <a href="{{route('welcome')}}"
                               class="{{\Illuminate\Support\Facades\Route::current()->getName() === 'welcome' ? 'bg-gray-900 text-white' : 'text-gray-500 hover:bg-gray-700 hover:text-white'}} rounded-md px-3 py-2 text-sm font-medium"
                               aria-current="page">Home</a>
                            <a href="{{route('internships.index')}}"
                               class="{{\Illuminate\Support\Facades\Route::current()->getName() === 'internships.index' ? 'bg-gray-900 text-white' : 'text-gray-500 hover:bg-gray-700 hover:text-white'}} rounded-md px-3 py-2 text-sm font-medium">Available
                                Internships</a>
                            <a href="{{route('internships.passed')}}"
                               class="{{\Illuminate\Support\Facades\Route::current()->getName() === 'internships.passed' ? 'bg-gray-900 text-white' : 'text-gray-500 hover:bg-gray-700 hover:text-white'}} rounded-md px-3 py-2 text-sm font-medium">Passed
                                Internships</a>
                            <a href="{{route('BeforeLoggingIn.about')}}"
                               class="{{\Illuminate\Support\Facades\Route::current()->getName() === 'BeforeLoggingIn.about' ? 'bg-gray-900 text-white' : 'text-gray-500 hover:bg-gray-700 hover:text-white'}} rounded-md px-3 py-2 text-sm font-medium">About
                                us</a>
                            <a href="{{route('BeforeLoggingIn.contact')}}"
                               class="{{\Illuminate\Support\Facades\Route::current()->getName() === 'BeforeLoggingIn.contact' ? 'bg-gray-900 text-white' : 'text-gray-500 hover:bg-gray-700 hover:text-white'}} rounded-md px-3 py-2 text-sm font-medium">Contact</a>
                        </div>
                    </div>
                </div>
            @if(auth()->user() === null)
                <div
                    class="absolute inset-y-0 right-0 items-center pr-2 sm:static sm:inset-auto sm:ml-6 sm:pr-0 hidden sm:flex">
                    <a href="{{route('login')}}"
                       class="hover:bg-gray-900 hover:text-white rounded-md px-3 py-2 text-sm font-medium mr-2">{{__('Log
                    In')}}</a>
                    <a href="{{route('register')}}"
                       class="hover:bg-gray-900 hover:text-white rounded-md px-3 py-2 text-sm font-medium">{{__('Sign
                    Up')}}</a>
                </div>
            @endif
            </div>
        </div>

        <!-- Mobile menu, show/hide based on menu state. -->
        <div
            class="w-2/3 -left-2/3 bg-purple-500 fixed h-screen z-30 top-0 px-10 py-5 overflow-x-hidden transition-all duration-300 ease-in"
            id="mobile-menu">
            <span id="closeMenu"
                  class="text-red-700 font-bold text-3xl ml-36 hover:text-zinc-50 hover:bg-emerald-950 py-2 px-4 rounded-full transition-all duration-500 ease-out">X</span>
            <div class="flex flex-col space-y-1 px-2 pb-3 pt-2 text-black mt-12">
                <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
                <a href="{{route('welcome')}}"
                   class="text-center {{\Illuminate\Support\Facades\Route::current()->getName() === 'welcome' ? 'bg-gray-900 text-white' : 'text-gray-900 hover:bg-gray-700 hover:text-white'}} rounded-md px-3 py-2 text-sm font-medium"
                   aria-current="page">{{__('Home')}}</a>
                <a href="{{route('internships.index')}}"
                   class="text-center {{\Illuminate\Support\Facades\Route::current()->getName() === 'internships.index' ? 'bg-gray-900 text-white' : 'text-gray-900 hover:bg-gray-700 hover:text-white'}} rounded-md px-3 py-2 text-sm font-medium">{{__('Internships')}}</a>
                <a href="{{route('BeforeLoggingIn.about')}}"
                   class="text-center {{\Illuminate\Support\Facades\Route::current()->getName() === 'BeforeLoggingIn.about' ? 'bg-gray-900 text-white' : 'text-gray-900 hover:bg-gray-700 hover:text-white'}} rounded-md px-3 py-2 text-sm font-medium">{{__('About
                            us')}}</a>
                <a href="{{route('BeforeLoggingIn.contact')}}"
                   class="text-center {{\Illuminate\Support\Facades\Route::current()->getName() === 'BeforeLoggingIn.contact' ? 'bg-gray-900 text-white' : 'text-gray-900 hover:bg-gray-700 hover:text-white'}} rounded-md px-3 py-2 text-sm font-medium">{{__('Contact')}}</a>
                @if(auth()->user() === null)
                    <a href="{{route('login')}}"
                       class="text-center hover:bg-gray-900 hover:text-white rounded-md px-3 py-2 text-sm font-medium mr-2">{{__('Log
                    In')}}</a>
                    <a href="{{route('register')}}"
                       class="text-center hover:bg-gray-900 hover:text-white rounded-md px-3 py-2 text-sm font-medium">{{__('Sign
                    Up')}}</a>
                @endif
            </div>
    </nav>
    {{$slot}}
    {{-- Footer --}}
    <br>
    <footer class="bg-white dark:bg-gray-900">
        <div class="mx-auto w-full max-w-screen-xl">
            <div class="grid grid-cols-2 gap-8 px-4 py-6 lg:py-8 md:grid-cols-4">
                <div>
                    <h2 class="mb-6 text-sm font-semibold text-gray-900 uppercase dark:text-white">Portal</h2>
                    <ul class="text-gray-500 dark:text-gray-400 font-medium">
                        <li class="mb-4">
                            <a href="{{route('welcome')}}" class=" hover:underline">Home</a>
                        </li>
                        <li class="mb-4">
                            <a href="{{route('internships.index')}}" class="hover:underline">Available Internships</a>
                        </li>
                        <li class="mb-4">
                            <a href="{{route('internships.passed')}}" class="hover:underline">Passed Internships</a>
                        </li>
                        <li class="mb-4">
                            <a href="{{ route('BeforeLoggingIn.about') }}" class="hover:underline">About us</a>
                        </li>
                        <li class="mb-4">
                            <a href="{{ route('BeforeLoggingIn.contact') }}" class="hover:underline">Contact</a>
                        </li>
                    </ul>
                </div>
                <div>
                    <h2 class="mb-6 text-sm font-semibold text-gray-900 uppercase dark:text-white">Help center</h2>
                    <ul class="text-gray-500 dark:text-gray-400 font-medium">
                        <li class="mb-4">
                            <a href="#" class="hover:underline">Discord Server</a>
                        </li>
                        <li class="mb-4">
                            <a href="#" class="hover:underline">Twitter</a>
                        </li>
                        <li class="mb-4">
                            <a href="#" class="hover:underline">Facebook</a>
                        </li>
                        <li class="mb-4">
                            <a href="#" class="hover:underline">Contact Us</a>
                        </li>
                    </ul>
                </div>
                <div>
                    <h2 class="mb-6 text-sm font-semibold text-gray-900 uppercase dark:text-white">Legal</h2>
                    <ul class="text-gray-500 dark:text-gray-400 font-medium">
                        <li class="mb-4">
                            <a href="#" class="hover:underline">Privacy Policy</a>
                        </li>
                        <li class="mb-4">
                            <a href="#" class="hover:underline">Licensing</a>
                        </li>
                        <li class="mb-4">
                            <a href="#" class="hover:underline">Terms &amp; Conditions</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="px-4 py-6 bg-purple-500 dark:bg-purple-700 md:flex md:items-center md:justify-between">
        <span class="text-sm text-white sm:text-center">© 2024 <a href="https://syntess.nl/">Syntess</a> & Team 13. All Rights Reserved.
        </span>
                <div class="flex mt-4 sm:justify-center md:mt-0 space-x-5 rtl:space-x-reverse">
                    <a href="#" class="text-white hover:text-gray-900 dark:hover:text-white">
                        <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                             viewBox="0 0 8 19">
                            <path fill-rule="evenodd"
                                  d="M6.135 3H8V0H6.135a4.147 4.147 0 0 0-4.142 4.142V6H0v3h2v9.938h3V9h2.021l.592-3H5V3.591A.6.6 0 0 1 5.592 3h.543Z"
                                  clip-rule="evenodd"/>
                        </svg>
                        <span class="sr-only">Facebook page</span>
                    </a>
                    <a href="#" class="text-white hover:text-gray-900 dark:hover:text-white">
                        <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                             viewBox="0 0 21 16">
                            <path
                                d="M16.942 1.556a16.3 16.3 0 0 0-4.126-1.3 12.04 12.04 0 0 0-.529 1.1 15.175 15.175 0 0 0-4.573 0 11.585 11.585 0 0 0-.535-1.1 16.274 16.274 0 0 0-4.129 1.3A17.392 17.392 0 0 0 .182 13.218a15.785 15.785 0 0 0 4.963 2.521c.41-.564.773-1.16 1.084-1.785a10.63 10.63 0 0 1-1.706-.83c.143-.106.283-.217.418-.33a11.664 11.664 0 0 0 10.118 0c.137.113.277.224.418.33-.544.328-1.116.606-1.71.832a12.52 12.52 0 0 0 1.084 1.785 16.46 16.46 0 0 0 5.064-2.595 17.286 17.286 0 0 0-2.973-11.59ZM6.678 10.813a1.941 1.941 0 0 1-1.8-2.045 1.93 1.93 0 0 1 1.8-2.047 1.919 1.919 0 0 1 1.8 2.047 1.93 1.93 0 0 1-1.8 2.045Zm6.644 0a1.94 1.94 0 0 1-1.8-2.045 1.93 1.93 0 0 1 1.8-2.047 1.918 1.918 0 0 1 1.8 2.047 1.93 1.93 0 0 1-1.8 2.045Z"/>
                        </svg>
                        <span class="sr-only">Discord community</span>
                    </a>
                    <a href="#" class="text-white hover:text-gray-900 dark:hover:text-white">
                        <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                             viewBox="0 0 20 17">
                            <path fill-rule="evenodd"
                                  d="M20 1.892a8.178 8.178 0 0 1-2.355.635 4.074 4.074 0 0 0 1.8-2.235 8.344 8.344 0 0 1-2.605.98A4.13 4.13 0 0 0 13.85 0a4.068 4.068 0 0 0-4.1 4.038 4 4 0 0 0 .105.919A11.705 11.705 0 0 1 1.4.734a4.006 4.006 0 0 0 1.268 5.392 4.165 4.165 0 0 1-1.859-.5v.05A4.057 4.057 0 0 0 4.1 9.635a4.19 4.19 0 0 1-1.856.07 4.108 4.108 0 0 0 3.831 2.807A8.36 8.36 0 0 1 0 14.184 11.732 11.732 0 0 0 6.291 16 11.502 11.502 0 0 0 17.964 4.5c0-.177 0-.35-.012-.523A8.143 8.143 0 0 0 20 1.892Z"
                                  clip-rule="evenodd"/>
                        </svg>
                        <span class="sr-only">Twitter page</span>
                    </a>
                    <a href="#" class="text-white hover:text-gray-900 dark:hover:text-white">
                        <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                             viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                  d="M10 .333A9.911 9.911 0 0 0 6.866 19.65c.5.092.678-.215.678-.477 0-.237-.01-1.017-.014-1.845-2.757.6-3.338-1.169-3.338-1.169a2.627 2.627 0 0 0-1.1-1.451c-.9-.615.07-.6.07-.6a2.084 2.084 0 0 1 1.518 1.021 2.11 2.11 0 0 0 2.884.823c.044-.503.268-.973.63-1.325-2.2-.25-4.516-1.1-4.516-4.9A3.832 3.832 0 0 1 4.7 7.068a3.56 3.56 0 0 1 .095-2.623s.832-.266 2.726 1.016a9.409 9.409 0 0 1 4.962 0c1.89-1.282 2.717-1.016 2.717-1.016.366.83.402 1.768.1 2.623a3.827 3.827 0 0 1 1.02 2.659c0 3.807-2.319 4.644-4.525 4.889a2.366 2.366 0 0 1 .673 1.834c0 1.326-.012 2.394-.012 2.72 0 .263.18.572.681.475A9.911 9.911 0 0 0 10 .333Z"
                                  clip-rule="evenodd"/>
                        </svg>
                        <span class="sr-only">GitHub account</span>
                    </a>
                </div>
            </div>
        </div>
        </div>
    </footer>
@endif
<script>
    const burger = document.getElementById('burger');
    const menu = document.getElementById('mobile-menu');
    burger.addEventListener('click', (e) => {
        e.currentTarget.style.opacity = 0;
        menu.classList.remove('-left-2/3');
        menu.classList.add('left-0');
    });
    document.getElementById('closeMenu').addEventListener('click', () => {
        burger.style.opacity = '100%';
        menu.classList.remove('left-0');
        menu.classList.add('-left-2/3');
    })
</script>
</body>
</html>
