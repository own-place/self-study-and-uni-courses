<x-main-before-logging>
    <div class="bg-white">
        <div class="mx-auto grid max-w-2xl grid-cols-1 items-center gap-x-8 gap-y-16 px-4 mt-24 mb-24 lg:max-w-7xl lg:grid-cols-2 lg:px-8">
            <div>
                <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">{{ $internship->title }}</h2>
                <p class="mt-4 text-gray-500">{{ $internship->description }}</p>
                @if(\Illuminate\Support\Facades\Auth::user() && \Illuminate\Support\Facades\Auth::user()->application === null)

                    <div class="flex mt-5">
                        <a href="{{ route('apply.form', $internship) }}" class="transition bg-black hover:scale-105 text-white ease-in-out duration-300 cursor-pointer p-2 px-8 border rounded-lg font-semibold">
                            Apply
                        </a>
                    </div>
                @endif

                <dl class="mt-8 grid grid-cols-1 gap-x-6 gap-y-10 sm:grid-cols-2 sm:gap-y-16 lg:gap-x-8">
                    <div class="border-t border-gray-200 pt-4">
                        <dt class="font-medium text-gray-900">{{__('Example assignments')}}</dt>
                        <dd class="mt-2 text-sm text-gray-500">
                            <ul class="list-disc pl-4">
                                @if(empty($tech_stack))
                                    <li>No technical details specified!</li>
                                @else
                                    @foreach($tech_stack as $tech)
                                        <li>{{ __($tech) }}</li>
                                    @endforeach
                                @endif
                            </ul>
                        </dd>
                    </div>
                    <div class="border-t border-gray-200 pt-4">
                        <dt class="font-medium text-gray-900">Language</dt>
                        <dd class="mt-2 text-sm text-gray-500">{{ $internship->language->name }}</dd>
                    </div>
                    <div class="border-t border-gray-200 pt-4">
                        <dt class="font-medium text-gray-900">{{__('Salary')}}</dt>
                        <dd class="mt-2 text-sm text-gray-500">{{ $internship->salary }}$</dd>
                    </div>
                    <div class="border-t border-gray-200 pt-4">
                        <dt class="font-medium text-gray-900">In which year</dt>
                        <dd class="mt-2 text-sm text-gray-500">{{ $internship->yearLevel->level }}</dd>
                    </div>
                </dl>
            </div>
            <div class="grid grid-cols-2 grid-rows-2 gap-4 sm:gap-6 lg:gap-8">
                @if($internship->category->name == 'Data Science')
                    <img src="{{ asset('images/LP_data_science_cover.jpg') }}" alt="LP_data_science_cover" class="col-span-2 row-span-2 rounded-lg bg-gray-100 {{$internship->passed == 1 ? 'grayscale opacity-80 hover:opacity-100' : ''}}">
                @elseif($internship->category->name == 'Business IT Consultancy')
                    <img src="{{ asset('images/LP_business_it_consultancy_cover.jpg') }}" alt="LP_business_it_consultancy_cover" class="col-span-2 row-span-2 rounded-lg bg-gray-100 {{$internship->passed == 1 ? 'grayscale opacity-80 hover:opacity-100' : ''}}">
                @elseif($internship->category->name == 'Software Engineering')
                    <img src="{{ asset('images/LP_software_engineering_cover.jpg') }}" alt="LP_software_engineering_cover" class="col-span-2 row-span-2 rounded-lg bg-gray-100 {{$internship->passed == 1 ? 'grayscale opacity-80 hover:opacity-100' : ''}}">
                @else
                    <img src="{{ asset('images/LP_main_photo.jpg') }}" alt="LP_main_photo" class="col-span-2 row-span-2 rounded-lg bg-gray-100">
                @endif
            </div>
        </div>
        @if(count($reviews) !== 0)
            <section class="flex flex-col justify-center items-center px-8 mx-auto mb-10">
                <h2 class="text-4xl font-semibold">Average Rating</h2>
                <div class="flex-col flex justify-center items-center mt-4">
                    <h3 class="text-2xl text-purple-700 font-semibold">{{$internship->avgRating}}</h3>
                    <div class="flex items-center justify-center mb-1 space-x-1 rtl:space-x-reverse">
                        <svg class="w-7 h-7 {{$internship->avgRating >= 1 ? 'text-yellow-300' : 'text-gray-300' }}" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                             fill="currentColor" viewBox="0 0 22 20">
                            <path
                                d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z"/>
                        </svg>
                        <svg class="w-7 h-7 {{$internship->avgRating >= 2 ? 'text-yellow-300' : 'text-gray-300' }}" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                             fill="currentColor" viewBox="0 0 22 20">
                            <path
                                d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z"/>
                        </svg>
                        <svg class="w-7 h-7 {{$internship->avgRating >= 3 ? 'text-yellow-300' : 'text-gray-300' }}" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                             fill="currentColor" viewBox="0 0 22 20">
                            <path
                                d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z"/>
                        </svg>
                        <svg class="w-7 h-7 {{$internship->avgRating >= 4 ? 'text-yellow-300' : 'text-gray-300' }}" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                             fill="currentColor" viewBox="0 0 22 20">
                            <path
                                d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z"/>
                        </svg>
                        <svg class="w-7 h-7 {{$internship->avgRating == 5 ? 'text-yellow-300' : 'text-gray-300' }}" aria-hidden="true"
                             xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                            <path
                                d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z"/>
                        </svg>
                    </div>
                </div>
                <h2 class="text-2xl font-semibold mt-10">Recent reviews:</h2>
            </section>
            <div class="flex flex-col justify-center items-center">
                @include('internships.partials.reviews', ['reviews' => $reviews])
                <a id="moreButton" class="font-semibold w-1/6 transition-all duration-200 ease-out cursor-pointer hover:scale-110 rounded-3xl py-5 px-10 text-xl bg-purple-500 text-zinc-50 text-center">
                    Load More Reviews
                </a>
            </div>
        @else
            <h2 class="px-8 mx-auto mb-10 text-4xl font-semibold flex flex-col justify-center items-center">No reviews yet</h2>
        @endif
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        let count = {{ count($reviews) }};
        let hasHidden = false;
        $(document).ready(function(){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('#moreButton').click(function() {
                $.ajax({
                    url: '{{ route('internship.getMoreReviews') }}',
                    type: 'GET',
                    contentType: 'application/json', // Set the content type to JSON
                    data: {
                        id: {{ $internship->id }},
                        count: count
                    },
                    success: function(data) {
                        if (count >= {{ count($internship->reviews) }} && !hasHidden) {
                            document.getElementById('moreButton').classList.add('hidden');
                            hasHidden = true;
                        }
                        $('#reviews').html(data);
                    },
                    error: function(xhr) {
                        console.error(xhr.responseText);
                    }
                });
                count += 3;
            });
        });
    </script>
</x-main-before-logging>
