@php
use App\Models\Internship
@endphp

<x-main-before-logging>
{{--  Taiwind component - https://tailwindui.com/components/marketing/sections/header  --}}
    <div class="relative isolate overflow-hidden py-24 ">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <div class="flex flex-wrap">
                <div class="w-full md:w-1/2 px-4">
                    <h2 class="text-4xl font-bold tracking-tight text-black sm:text-6xl">{{__('Web-based internship portal')}}</h2>
                    <p class="mt-6 text-lg leading-8 text-gray-500">{{__('Embark on a journey where opportunities meet
                        ambition in our cutting-edge
                        internship portal, designed to bridge the gap between talented individuals and their dream
                        roles.
                        Dive into a world of possibilities, where every click brings you closer to the next big step in
                        your career.')}}</p>
                    <div class="grid grid-cols-1 gap-x-8 gap-y-6 text-base font-semibold leading-7 text-black sm:grid-cols-2 md:flex lg:gap-x-10 mt-12">
                        <a href="{{ route('internships.index') }}" class="modern-link block py-2 px-4 rounded-lg relative overflow-hidden transition-all duration-300 hover:bg-purple-500 hover:text-white">
                            <span class="absolute inset-0 bg-purple-500 transition-transform duration-500 transform translate-x-[-110%]"></span>
                            <span class="relative z-10">Open internships <span aria-hidden="true">&rarr;</span></span>
                        </a>
                        <a href="{{ route('BeforeLoggingIn.contact') }}" class="modern-link block py-2 px-4 rounded-lg relative overflow-hidden transition-all duration-300 hover:bg-purple-500 hover:text-white">
                            <span class="absolute inset-0 bg-purple-500 transition-transform duration-500 transform translate-x-[-110%]"></span>
                            <span class="relative z-10">Contact us <span aria-hidden="true">&rarr;</span></span>
                        </a>
                        <a href="{{ route('BeforeLoggingIn.about') }}" class="modern-link block py-2 px-4 rounded-lg relative overflow-hidden transition-all duration-300 hover:bg-purple-500 hover:text-white">
                            <span class="absolute inset-0 bg-purple-500 transition-transform duration-500 transform translate-x-[-110%]"></span>
                            <span class="relative z-10">Meet our team <span aria-hidden="true">&rarr;</span></span>
                        </a>
                    </div>
                </div>
                <div class="w-full md:w-1/2 px-4">
                    <img src="{{ asset('images/LP_main_photo.jpg') }}" alt="Landing page educational oriented picture - a cartoon with a girl writing on a laptop on a desk" class="max-w-full h-auto">
                </div>
            </div>

            <div class="mx-auto mt-10 max-w-2xl lg:mx-0 lg:max-w-none">
                <dl class="mt-16 grid grid-cols-1 gap-8 sm:mt-20 sm:grid-cols-2 lg:grid-cols-4">
                    <div class="flex flex-col-reverse">
                        <dt class="text-base leading-7 text-gray-500">Offices in the Netherlands</dt>
                        <dd class="text-2xl font-bold leading-9 tracking-tight text-black">2</dd>
                    </div>
                    <div class="flex flex-col-reverse">
                        <dt class="text-base leading-7 text-gray-500">Full-time colleagues</dt>
                        <dd class="text-2xl font-bold leading-9 tracking-tight text-black">100+</dd>
                    </div>
                    <div class="flex flex-col-reverse">
                        <dt class="text-base leading-7 text-gray-500">Hours per week</dt>
                        <dd class="text-2xl font-bold leading-9 tracking-tight text-black">20</dd>
                    </div>
                    <div class="flex flex-col-reverse">
                        <dt class="text-base leading-7 text-gray-500">Available internships</dt>
                        <dd class="text-2xl font-bold leading-9 tracking-tight text-black">{{$count = Internship::where('passed', 0)->count();}}</dd>
                    </div>
                </dl>
            </div>
        </div>
    </div>

{{-- Popular internships --}}
{{-- Tailwing component: https://tailwindui.com/components/marketing/sections/blog-sections --}}
    <div class="mx-auto max-w-7xl px-6 lg:px-8">
        <div class="mx-auto max-w-2xl lg:mx-0">
            <h2 class="text-3xl font-bold tracking-tight text-black sm:text-4xl">{{__('Popular internships')}}</h2>
            <p class="mt-2 text-lg leading-8 text-gray-800">{{__('Browse through the most popular internships that are
                currently available.')}}</p>
        </div>
        <div class="mx-auto grid max-w-2xl grid-cols-1 gap-x-8 pt-10 sm:mt-1 lg:mx-0 lg:max-w-none lg:grid-cols-3">
            @include('internships.partials.internship_list', ['internships' => $internships])
        </div>
    </div>

    {{-- 3 types of interships --}}
    <section class="mx-auto max-w-7xl px-6 lg:px-8 mt-24">
        <div class="mx-auto max-w-2xl lg:mx-0 mb-12">
            <h2 class="text-3xl font-bold tracking-tight text-black sm:text-4xl">{{__('Popular internships')}}</h2>
            <p class="mt-2 text-lg leading-8 text-gray-800">{{__('Browse through the most popular internships that are
                currently available.')}}</p>
        </div>
        <div class="mb-5">
            <a href="{{ route('internships.index', ['category' => 2]) }}" class="block rounded-lg relative p-5 transform transition-all duration-300 scale-100 hover:scale-95 shadow-md" style="background: url({{ asset('images/LP_software_engineering_cover.jpg') }}) center; background-size: cover;">
                <div class="h-48"></div>
                <h2 class="text-white text-2xl font-bold leading-tight mb-3 pr-5">{{__('Software engineering')}}</h2>
            </a>
        </div>
        <div class="mb-5">
            <a href="{{ route('internships.index', ['category' => 1]) }}" class="block rounded-lg relative p-5 transform transition-all duration-300 scale-100 hover:scale-95 shadow-md" style="background: url({{ asset('images/LP_data_science_cover.jpg') }}) center; background-size: cover;">
                <div class="h-48"></div>
                <h2 class="text-white text-2xl font-bold leading-tight mb-3 pr-5">{{__('Data Science')}}</h2>
            </a>
        </div>
        <div class="mb-5">
            <a href="{{ route('internships.index', ['category' => 3]) }}" class="block rounded-lg relative p-5 transform transition-all duration-300 scale-100 hover:scale-95 shadow-md" style="background: url({{ asset('images/LP_business_it_consultancy_cover.jpg') }}) center; background-size: cover;">
                <div class="h-48"></div>
                <h2 class="text-white text-2xl font-bold leading-tight mb-3 pr-5">{{__('Business IT Consultancy')}}</h2>
            </a>
        </div>
    </section>
</x-main-before-logging>
