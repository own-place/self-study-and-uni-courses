<x-main-dashboard-user>
    <div class="p-4 sm:ml-64 flex mt-10 flex-wrap">
        <div class="w-full lg:grid lg:grid-cols-2 lg:gap-10 m-6">
            <div class="lg:col-span-2">
                <form action="{{ route('admin.internships.store') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label for="title" class="block text-gray-700 text-sm font-bold mb-2">Title:</label>
                        <input type="text" name="title" id="title"
                               class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        @error('title')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="description" class="block text-gray-700 text-sm font-bold mb-2">Description:</label>
                        <textarea name="description" id="description" rows="5"
                                  class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"></textarea>
                        @error('description')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="category_id" class="block text-gray-700 text-sm font-bold mb-2">Category:</label>
                        <select name="category_id" id="category_id"
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                            <option value="" selected disabled>Select category</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                        @error('category_id')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="language_id" class="block text-gray-700 text-sm font-bold mb-2">Language:</label>
                        <select name="language_id" id="language_id"
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                            <option value="" selected disabled>Select language</option>
                            @foreach ($languages as $language)
                                <option value="{{ $language->id }}">{{ $language->name }}</option>
                            @endforeach
                        </select>
                        @error('language_id')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="year_level_id" class="block text-gray-700 text-sm font-bold mb-2">Year Level:</label>
                        <select name="year_level_id" id="year_level_id"
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                            <option value="" selected disabled>Select year level</option>
                            @foreach ($yearLevels as $yearLevel)
                                <option value="{{ $yearLevel->id }}">{{ $yearLevel->level }}</option>
                            @endforeach
                        </select>
                        @error('year_level_id')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="salary" class="block text-gray-700 text-sm font-bold mb-2">Salary:</label>
                        <input type="number" name="salary" id="salary"
                               class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        @error('salary')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="techstack" class="block text-gray-700 text-sm font-bold mb-2">Tech Stack:</label>
                        <div class="grid grid-cols-2 gap-4">
                            @foreach ($technologies as $technology)
                                <label class="inline-flex items-center">
                                    <input type="checkbox" name="techstack[]" value="{{ $technology->id }}"
                                           class="form-checkbox h-5 w-5 text-gray-600">
                                    <span class="ml-2 text-gray-700">{{ $technology->name }}</span>
                                </label>
                            @endforeach
                        </div>
                        @error('techstack')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="passed" class="block text-gray-700 text-sm font-bold mb-2">Passed:</label>
                        <input type="checkbox" name="passed" id="passed" class="mr-2 leading-tight">
                        @error('passed')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="flex items-center justify-between">
                        <x-primary-button>
                            Create Internship
                        </x-primary-button>
                        <a href="{{ route('admin.internships.index') }}"
                           class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800">
                            Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-main-dashboard-user>
