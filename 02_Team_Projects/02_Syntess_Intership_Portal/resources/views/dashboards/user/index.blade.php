@php
    (new \App\Http\Controllers\ApplicationController())->checkAndUpdateStep();
@endphp
<x-main-dashboard-user>
    <div class="p-4 sm:ml-64 flex mt-10 flex-wrap">
        <div class="w-full lg:grid lg:grid-cols-3 lg:gap-10 m-6">
            <div class="lg:col-span-2">
                <div
                    class="bg-gradient-to-r from-purple-500 to-purple-700 shadow-lg rounded-lg p-4 mx-auto lg:mx-0 flex items-center justify-center mb-4 text-white border-4 border-purple-600">
                    <div class="text-center px-6">
                        <h2 class="text-2xl font-bold">Welcome, {{ Auth::user()->role->name }}
                            <em>{{ Auth::user()->first_name }}!</em></h2>
                        <p class="mt-2">We're excited to have you on board. Good luck in finding your perfect
                            internship!</p>
                    </div>
                    <div class="mt-4 mix-blend-luminosity">
                        <img src="{{ asset('images/LP_main_photo.png') }}" alt="Welcome Image"
                             class="h-48 object-cover">
                    </div>
                </div>

                <!-- Statistics -->
                <x-statistics-numbers gridClass="cols"/>

                <x-quote-of-the-day/>

                {{--hobbies quiz--}}
                @can('isCandidate', \App\Models\User::class)
                    <div id="hobbySection"
                         class="mb-6 border-l-4 border-purple-500 bg-purple-50 p-4 flex items-center">
                        <i class="fas fa-exclamation-circle text-purple-500 mr-3"></i>
                        <div>
                            <p class="mb-2 text-purple-700 font-semibold">Take the quiz to get connected with the best
                                mentor! :)</p>
                            <x-primary-button type="button" class="bg-purple-500 hover:bg-purple-200"
                                              onclick="openQuizModal()">
                                Hobby Quiz
                            </x-primary-button>
                        </div>
                    </div>

                    <div id="quizModal"
                         class="fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-75 z-50 hidden">
                        <div class="bg-white p-6 rounded-lg shadow-lg w-96">
                            <h2 class="text-xl font-bold mb-4">Select Your Hobbies</h2>
                            <form id="hobbyForm" action="{{ route('quiz.save') }}" method="POST">
                                @csrf
                                <div class="mb-4">
                                    @foreach (['Reading', 'Traveling', 'Cooking', 'Sports', 'Music', 'Gardening', 'Photography', 'Drawing', 'Gaming', 'Writing'] as $hobby)
                                        <div class="flex items-center mb-2">
                                            <input type="checkbox" name="hobbies[]" value="{{ $hobby }}" class="mr-2">
                                            <label>{{ $hobby }}</label>
                                        </div>
                                    @endforeach
                                </div>
                                <x-primary-button type="submit">Save</x-primary-button>
                                <x-secondary-button type="button" onclick="closeQuizModal()">
                                    Close
                                </x-secondary-button>
                            </form>
                        </div>
                    </div>
                @endcan

                {{--                @if(auth()->user()->application && auth()->user()->application->current_step === 2)--}}
                {{--                    @php--}}
                {{--                        $interviewDateTime = auth()->user()->application->interview->date . ' ' . auth()->user()->application->interview->time;--}}
                {{--                    @endphp--}}
                {{--                    <x-countdown :dateTime="$interviewDateTime"/>--}}
                {{--                @endif--}}

                @can('isStudent', \App\Models\User::class)
                    {{-- 3 types of interships--}}
                    <div class="mx-auto mt-8">
                        <div class="mx-auto lg:mx-0 mb-12">
                            <h2 class="text-3xl font-bold tracking-tight text-black sm:text-4xl">Popular
                                internships</h2>
                            <p class="mt-2 text-lg leading-8 text-gray-800">Browse through the most popular internships
                                that
                                are currently available.</p>
                        </div>

                        @foreach($internships as $internship)
                            @if($loop->index < 1)
                                <div class="mb-5">
                                    <a href="{{route('internships.index', ['category' => 2])}}"
                                       class="block rounded-lg relative p-5 transform transition-all duration-300 scale-100 hover:scale-95 shadow-md"
                                       style="background: url({{asset('images/LP_software_engineering_cover.jpg')}}) center; background-size: cover;">
                                        <div class="h-48"></div>
                                        <h2 class="text-white text-2xl font-bold leading-tight mb-3 pr-5">Software
                                            engineering</h2>
                                    </a>
                                </div>
                                <div class="mb-5">
                                    <a href="{{ route('internships.index', ['category' => 1]) }}"
                                       class="block rounded-lg relative p-5 transform transition-all duration-300 scale-100 hover:scale-95 shadow-md"
                                       style="background: url({{asset('images/LP_data_science_cover.jpg')}}) center; background-size: cover;">
                                        <div class="h-48"></div>
                                        <h2 class="text-white text-2xl font-bold leading-tight mb-3 pr-5">Data
                                            Science</h2>
                                    </a>
                                </div>
                                <div class="mb-5">
                                    <a href="{{ route('internships.index', ['category' => 3]) }}"
                                       class="block rounded-lg relative p-5 transform transition-all duration-300 scale-100 hover:scale-95 shadow-md"
                                       style="background: url({{asset('images/LP_business_it_consultancy_cover.jpg')}}) center; background-size: cover;">
                                        <div class="h-48"></div>
                                        <h2 class="text-white text-2xl font-bold leading-tight mb-3 pr-5">Business IT
                                            Consultancy</h2>
                                    </a>
                                </div>
                            @endif
                        @endforeach

                    </div>
            </div>
            @endcan

            @can('isCandidate', \App\Models\User::class)
        </div>
        <div class="flex flex-col w-full lg:w-auto rounded-lg">
            <x-application-tracking></x-application-tracking>
            @else
                <div class="flex flex-col w-full lg:w-auto rounded-lg">
                    <x-calendar></x-calendar>
                    @endcan
                </div>
        </div>

        <script>
            function openQuizModal() {
                document.getElementById('quizModal').classList.remove('hidden');
            }

            function closeQuizModal() {
                document.getElementById('quizModal').classList.add('hidden');
            }
        </script>
</x-main-dashboard-user>
