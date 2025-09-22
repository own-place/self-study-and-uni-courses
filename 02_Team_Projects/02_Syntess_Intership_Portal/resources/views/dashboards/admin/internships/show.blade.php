<x-main-dashboard-user>
    <div class="p-4 sm:ml-64 flex mt-10">
        <div class="mt-10 max-w-3xl mx-auto bg-white shadow-md rounded-lg overflow-hidden">
            <div class="p-6">
                <h2 class="text-2xl font-bold mb-4">{{ $internship->title }}</h2>
                <div class="mb-4">
                    <p class="text-gray-700 text-base">{{ $internship->description }}</p>
                </div>
                <div class="flex items-center justify-between border-t border-gray-200 pt-4">
                    <div>
                        <p class="text-gray-600"><span class="font-bold">Language:</span> {{ $internship->language->name }}</p>
                        <p class="text-gray-600"><span class="font-bold">Category:</span> {{ $internship->category->name }}</p>
                        <p class="text-gray-600"><span class="font-bold">Year Level:</span> {{ $internship->yearLevel->level }}</p>
                        <p class="text-gray-600"><span class="font-bold">Salary:</span> ${{ $internship->salary }}</p>
                        <p class="text-gray-600"><span class="font-bold">Passed:</span> {{ $internship->passed ? 'Yes' : 'No' }}</p>
                        <p class="text-gray-600"><span class="font-bold">Tech Stack:</span></p>
                        <ul class="list-disc list-inside text-gray-700">
                            @foreach ($internship->technologies as $technology)
                                <li>{{ $technology->name }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="mt-6">
                    <form action="{{ route('admin.internships.edit', $internship->id) }}" method="GET" class="inline ml-2 mb-2">
                        @csrf
                        <x-primary-button type="submit">Edit</x-primary-button>
                    </form>
                    <form class="inline ml-2" action="{{ route('admin.internships.destroy', $internship->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this internship?')">
                        @csrf
                        @method('DELETE')
                        <x-primary-button type="submit" class="bg-red-500 hover:bg-red-600 text-white py-2 px-4 rounded">
                            Delete
                        </x-primary-button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-main-dashboard-user>
