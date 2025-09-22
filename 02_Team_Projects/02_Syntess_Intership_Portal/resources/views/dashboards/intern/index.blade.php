<x-main-dashboard-user>
    <div class="p-4 sm:ml-64 flex mt-10 flex-wrap">
        <div class="w-full lg:grid lg:grid-cols-3 lg:gap-10 m-6">
            <div class="lg:col-span-2">
                <div class="bg-gradient-to-r from-purple-500 to-purple-700 shadow-lg rounded-lg p-4 mx-auto lg:mx-0 flex items-center justify-center mb-4 text-white border-4 border-purple-600">
                    <div class="text-center px-6">
                        <h2 class="text-2xl font-bold">Welcome, <em>Intern {{ Auth::user()->first_name }}!</em></h2>
                        <p class="mt-2">We're excited to have you on board. Good luck with your internship!</p>
                    </div>
                    <div class="mt-4 mix-blend-luminosity">
                        <img src="{{ asset('images/LP_main_photo.png') }}" alt="Welcome Image" class="h-48 object-cover">
                    </div>
                </div>

                {{-- Countdown --}}
                {{-- Using a template from the IT Conference's website --}}
                <div class="mx-auto flex flex-row items-center justify-center mb-8">
                    <div class="flex flex-col items-center justify-center pt-4 md:flex lg:flex">
                        @if(Auth::user()->application->contract_document && Auth::user()->application->start_date > now())
                            <h2 class="text-xl font-bold text-purple-500 pb-2">
                                FIRST DAY: {{ Auth::user()->application->start_date->format('F d, Y') }}
                            </h2>
                            <x-countdown :dateTime="Auth::user()->application->start_date"/>
                        @elseif(Auth::user()->application->contract_document == NULL)
                            <h2 class="text-2xl font-bold text-red-500 mb-4">Internship START!</h2>
                            <p class="text-gray-600 mb-5 text-center">
                                <b>Congrats! you have been accepted to have an internship in Syntess! </b><br>
                                Your contract is in the process of creation. Stay tuned and check your email regularly
                                to sign it.
                                Whenever our HR employees prepare your contract and validate your internship's start and
                                end date,
                                you will get notified in this portal!
                            </p>
                        @elseif(Auth::user()->application->contract_document && Auth::user()->application->start_date < now())
                        @endif
                    </div>
                </div>

                <x-quote-of-the-day/>

                {{-- Fun facts about the company and statistics--}}
                <div class="w-full lg:grid lg:grid-cols-2 mt-12">
                    <x-fun-facts/>
                    <div class="relative w-full mx-auto mb-8">
                        <!-- Statistics -->
                        <x-statistics-numbers gridClass="rows"/>
                    </div>
                </div>

                {{-- Mentor card --}}
                {{-- still static - will need to figure out how to connect the intern with the mentor in the database--}}
                <div class="max-w-full mx-auto mt-10 mb-10 relative">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1"
                         stroke="#D4B3FF"
                         class="w-12 h-12 absolute top-3 left-3 transform -translate-x-3/4 -translate-y-1/2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M4.26 10.147a60.438 60.438 0 0 0-.491 6.347A48.62 48.62 0 0 1 12 20.904a48.62 48.62 0 0 1 8.232-4.41 60.46 60.46 0 0 0-.491-6.347m-15.482 0a50.636 50.636 0 0 0-2.658-.813A59.906 59.906 0 0 1 12 3.493a59.903 59.903 0 0 1 10.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.717 50.717 0 0 1 12 13.489a50.702 50.702 0 0 1 7.74-3.342M6.75 15a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Zm0 0v-3.675A55.378 55.378 0 0 1 12 8.443m-7.007 11.55A5.981 5.981 0 0 0 6.75 15.75v-1.5"/>
                    </svg>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                         stroke="#8749FF" class="w-12 h-12 absolute top-3 right-6 transform -translate-y-1/2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M16.5 12a4.5 4.5 0 1 1-9 0 4.5 4.5 0 0 1 9 0Zm0 0c0 1.657 1.007 3 2.25 3S21 13.657 21 12a9 9 0 1 0-2.636 6.364M16.5 12V8.25"/>
                    </svg>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                         stroke="#571EDD"
                         class="w-12 h-12 absolute bottom-3 left-6 transform translate-x-full translate-y-full">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M9.75 3.104v5.714a2.25 2.25 0 0 1-.659 1.591L5 14.5M9.75 3.104c-.251.023-.501.05-.75.082m.75-.082a24.301 24.301 0 0 1 4.5 0m0 0v5.714c0 .597.237 1.17.659 1.591L19.8 15.3M14.25 3.104c.251.023.501.05.75.082M19.8 15.3l-1.57.393A9.065 9.065 0 0 1 12 15a9.065 9.065 0 0 0-6.23-.693L5 14.5m14.8.8 1.402 1.402c1.232 1.232.65 3.318-1.067 3.611A48.309 48.309 0 0 1 12 21c-2.773 0-5.491-.235-8.135-.687-1.718-.293-2.3-2.379-1.067-3.61L5 14.5"/>
                    </svg>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1"
                         stroke="#BB91FF" class="w-12 h-12 absolute bottom-3 right-3 transform translate-x-full">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M20.25 8.511c.884.284 1.5 1.128 1.5 2.097v4.286c0 1.136-.847 2.1-1.98 2.193-.34.027-.68.052-1.02.072v3.091l-3-3c-1.354 0-2.694-.055-4.02-.163a2.115 2.115 0 0 1-.825-.242m9.345-8.334a2.126 2.126 0 0 0-.476-.095 48.64 48.64 0 0 0-8.048 0c-1.131.094-1.976 1.057-1.976 2.192v4.286c0 .837.46 1.58 1.155 1.951m9.345-8.334V6.637c0-1.621-1.152-3.026-2.76-3.235A48.455 48.455 0 0 0 11.25 3c-2.115 0-4.198.137-6.24.402-1.608.209-2.76 1.614-2.76 3.235v6.226c0 1.621 1.152 3.026 2.76 3.235.577.075 1.157.14 1.74.194V21l4.155-4.155"/>
                    </svg>

                    <div
                        class="bg-white p-6 rounded-lg shadow-lg hover:shadow-xl transition-shadow duration-300 ease-in-out">
                        <div class="flex items-center space-x-4">
                            <img
                                src="{{ Auth::user()->photo ? Storage::url(Auth::user()->photo) : 'https://flowbite.com/docs/images/people/profile-picture-5.jpg' }}"
                                alt="Mentor's Name" class="w-16 h-16 rounded-full border-3 border-purple-500">
                            <div>
                                <h3 class="text-xl font-bold text-gray-900">John Doe</h3>
                                <p class="text-gray-600">john.doe@example.com</p>
                                <p class="text-sm text-gray-500">Enjoys hiking and photography. Loves to watch Formula 1
                                    and Dutch National football league.</p>
                            </div>
                        </div>
                        <button
                            class="mt-4 w-full bg-purple-500 hover:bg-purple-700 text-white font-bold py-2 px-4 rounded transition-colors duration-300">
                            Learn More
                        </button>
                    </div>
                </div>
                @if(\Illuminate\Support\Facades\Auth::user()->application->end_date < now())
                    @if(\App\Models\Review::query()->where('user_id', '=', auth()->user()->id)->where('internship_id', '=', auth()->user()->application->internship_id)->get()->count() === 0)
                        <section class="border-purple-500 border-solid border-2 border-inset mt-14 p-10 mx-w-full rounded-2xl shadow-2xl flex-row flex justify-center items-center">
                            <form action="{{route('intern.review')}}" method="POST">
                                @csrf
                                <h2 class="text-2xl text-zinc-800 font-semibold">
                                    Are you satisfied with your experience? Leave a review!
                                </h2>
                                <div class="rating items-center justify-center mt-8">
                                    <input type="radio" id="star-1" name="star-rating" value="5">
                                    <label for="star-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path pathLength="360" d="M12,17.27L18.18,21L16.54,13.97L22,9.24L14.81,8.62L12,2L9.19,8.62L2,9.24L7.45,13.97L5.82,21L12,17.27Z"></path></svg>
                                    </label>
                                    <input type="radio" id="star-2" name="star-rating" value="4">
                                    <label for="star-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path pathLength="360" d="M12,17.27L18.18,21L16.54,13.97L22,9.24L14.81,8.62L12,2L9.19,8.62L2,9.24L7.45,13.97L5.82,21L12,17.27Z"></path></svg>
                                    </label>
                                    <input type="radio" id="star-3" name="star-rating" value="3">
                                    <label for="star-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path pathLength="360" d="M12,17.27L18.18,21L16.54,13.97L22,9.24L14.81,8.62L12,2L9.19,8.62L2,9.24L7.45,13.97L5.82,21L12,17.27Z"></path></svg>
                                    </label>
                                    <input type="radio" id="star-4" name="star-rating" value="2">
                                    <label for="star-4">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path pathLength="360" d="M12,17.27L18.18,21L16.54,13.97L22,9.24L14.81,8.62L12,2L9.19,8.62L2,9.24L7.45,13.97L5.82,21L12,17.27Z"></path></svg>
                                    </label>
                                    <input type="radio" id="star-5" name="star-rating" value="1">
                                    <label for="star-5">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path pathLength="360" d="M12,17.27L18.18,21L16.54,13.97L22,9.24L14.81,8.62L12,2L9.19,8.62L2,9.24L7.45,13.97L5.82,21L12,17.27Z"></path></svg>
                                    </label>
                                </div>
                                <x-input-error :messages="$errors->get('star-rating')" class="mt-4"/>
                                <div class="mt-10 mb-5">
                                    <label for="review" class="block text-sm font-medium leading-6 text-gray-900">Share your thoughts/experience:</label>
                                    <div class="mt-2">
                                    <textarea style="resize: vertical" rows="5" name="review" id="street-address"
                                              class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"></textarea>
                                    </div>
                                    <x-input-error :messages="$errors->get('review')" class="mt-2"/>
                                </div>
                                <x-checkbox>Anonymous review</x-checkbox>
                                <div class="mt-6 flex items-center justify-end gap-x-6">
                                    <button type="submit"
                                            class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                                        Submit
                                    </button>
                                </div>
                            </form>
                        </section>
                    @else
                        <section class="border-emerald-600 border-solid border-2 border-inset mt-14 p-10 mx-w-full rounded-2xl shadow-2xl flex-row flex justify-center items-center">
                            <h2 class="text-xl text-emerald-900 font-semibold text-center">
                                Thank you for your review! We take all reviews seriously in order to improve our services!
                            </h2>
                            <img src="{{asset('/images/checkmark.png')}}" alt="checkmark" class="object-cover w-1/3">
                        </section>
                    @endif
                @endif
            </div>

            <div class="flex flex-col w-full lg:w-auto rounded-lg">
                <x-calendar/>

                {{-- Checklist --}}
                <div class="mt-6 w-full p-6 bg-white bg-opacity-90 rounded-lg bg-cover shadow-lg">
                    <h2 class="text-lg font-semibold text-gray-800 text-center mb-3">Intern Checklist</h2>
                    <form method="POST" action="{{ route('intern.checklist.update') }}">
                        @csrf
                        <div class="space-y-4">
                            @foreach ($checklistItems as $key => $item)
                                <div class="flex items-center h-full border-b-2 border-dashed border-gray-300">
                                    <input id="item-{{ $key }}" type="checkbox" name="completed[]"
                                           value="{{ $key }}"
                                           class="form-checkbox h-5 w-5 text-purple-600" {{ $item['completed'] ? 'checked' : '' }}>
                                    <label for="item-{{ $key }}" class="ml-2 block"
                                           style="font-family: 'Indie Flower', cursive;">
                                        {{ $item['title'] }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                        <button type="submit"
                                class="mt-6 w-full bg-purple-500 hover:bg-purple-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                            Update Checklist
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-main-dashboard-user>
