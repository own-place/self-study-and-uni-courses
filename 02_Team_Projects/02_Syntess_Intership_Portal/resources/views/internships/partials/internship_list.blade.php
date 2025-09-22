@forelse($internships as $internship)
    <article class="relative flex max-w-xl flex-col items-start justify-between border border-gray-200 rounded-lg p-4 transition-shadow duration-300 hover:shadow-md">
        <a href="{{ route('internships.show', $internship) }}" class="block w-full">
            <img src="{{ asset('images/' . ($internship->category->name == 'Data Science' ? 'LP_data_science_cover.jpg' : ($internship->category->name == 'Business IT Consultancy' ? 'LP_business_it_consultancy_cover.jpg' : 'LP_software_engineering_cover.jpg'))) }}" alt="" class="max-w-full h-auto rounded-lg mb-4">
            <div class="flex items-center gap-x-4 text-xs">
                <time datetime="{{ $internship->created_at->toDateString() }}" class="text-gray-500">{{ $internship->created_at->format('M d, Y') }}</time>
                <p class="relative z-10 rounded-full bg-red-200 px-3 py-1.5 font-medium text-gray-600">{{ $internship->yearLevel->level }}</p>
                <p class="relative z-10 rounded-full bg-blue-200 px-3 py-1.5 font-medium text-gray-600">{{ $internship->language->name }}</p>
                <p class="relative z-10 rounded-full bg-green-200 px-3 py-1.5 font-medium text-gray-600">{{ $internship->salary }}$</p>
            </div>
            <div class="group relative">
                <h3 class="mt-3 text-lg font-semibold leading-6 text-gray-900 group-hover:text-gray-600">
                    <span class="absolute inset-0"></span>
                    {{ $internship->title }}
                </h3>
                <p class="mt-5 line-clamp-3 text-sm leading-6 text-gray-600">{{ $internship->description }}</p>
            </div>
        </a>
    </article>
@empty
    <div class="w-full flex flex-col items-center justify-center my-8">
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
            <p><strong class="font-bold text-lg">{{__('No internships found!')}}</strong></p>
            <p class="block sm:inline mt-2">{{__('It seems there are no internships matching your current filters. Please try
                adjusting your search criteria and filters to find more relevant opportunities.')}}</p>
        </div>
        <a href="{{ route('internships.index') }}" class="mt-4 inline-block bg-black text-white font-bold py-2 px-4 rounded hover:bg-blue-700 transition duration-300">
            {{__('Reset Filters')}}
        </a>
    </div>
@endforelse
