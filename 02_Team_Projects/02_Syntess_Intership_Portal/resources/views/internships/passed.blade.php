<x-main-before-logging>
    <div class="mx-auto max-w-7xl px-6 lg:px-8 mt-12">
        <div class="mx-auto lg:mx-0">
            <h2 class="text-3xl font-bold tracking-tight text-black sm:text-4xl">Our Passed Internships</h2>
            <p class="mt-2 text-lg leading-8 text-gray-800">Welcome to our comprehensive internship portal, your gateway to a world of exciting and diverse internship opportunities. Here, you can browse through all our internships that have already passed and are not currently available. Our platform is designed to connect students and recent graduates with valuable hands-on experiences in various fields from the technology sector. Start your journey towards a rewarding professional experience today by exploring the wide array of internships we had to offer to gain a better insight into our positions.</p>
        </div>

        <div class="bg-white mt-4">
            @if($passedInternships->isEmpty())
                <p class="text-gray-600">No passed internships available at the moment.</p>
            @else
                <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3">
                    @foreach($passedInternships as $internship)
                        <div class="relative flex flex-col items-start justify-between border border-gray-200 rounded-lg p-4 transition-shadow duration-300 hover:shadow-md bg-gray-50">
                            <a href="{{ route('internships.show', $internship) }}" class="block w-full">
                                <img src="{{ asset('images/' . ($internship->category->name == 'Data Science' ? 'LP_data_science_cover.jpg' : ($internship->category->name == 'Business IT Consultancy' ? 'LP_business_it_consultancy_cover.jpg' : 'LP_software_engineering_cover.jpg'))) }}" alt="" class="max-w-full h-auto rounded-lg mb-4 filter grayscale opacity-80 hover:opacity-100">
                                <div class="flex items-center gap-x-4 text-xs">
                                    <time datetime="{{ $internship->created_at->toDateString() }}" class="text-gray-500">{{ $internship->created_at->format('M d, Y') }}</time>
                                    <p class="relative z-10 rounded-full bg-gray-300 px-3 py-1.5 font-medium text-gray-600">{{ $internship->yearLevel->level }}</p>
                                    <p class="relative z-10 rounded-full bg-gray-400 px-3 py-1.5 font-medium text-gray-600">{{ $internship->language->name }}</p>
                                    <p class="relative z-10 rounded-full bg-gray-300 px-3 py-1.5 font-medium text-gray-600">${{ $internship->salary }}</p>
                                </div>
                                <div class="group relative">
                                    <h3 class="mt-3 text-lg font-semibold leading-6 text-gray-900 group-hover:text-gray-600">
                                        <span class="absolute inset-0"></span>
                                        {{ $internship->title }}
                                    </h3>
                                    <p class="mt-5 line-clamp-3 text-sm leading-6 text-gray-600">{{ $internship->description }}</p>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</x-main-before-logging>
