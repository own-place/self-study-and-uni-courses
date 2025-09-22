<x-main-dashboard-user>
    <div class="p-4 sm:ml-64 flex mt-10 flex-wrap">
        <div class="w-full lg:grid lg:grid-cols-2 lg:gap-10 m-6">
            <div class="lg:col-span-2">
                <h2 class="text-2xl font-bold mb-4">Edit Internship</h2>

                @if (session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4"
                         role="alert">
                        <span class="block sm:inline">{{ session('success') }}</span>
                    </div>
                @endif

                <form action="{{ route('admin.internships.update', $internship->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
                        <input type="text" name="title" id="title"
                               class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50"
                               value="{{ old('title', $internship->title) }}" required>
                        @error('title')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                        <textarea name="description" id="description" rows="3"
                                  class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50"
                                  required>{{ old('description', $internship->description) }}</textarea>
                        @error('description')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="category_id" class="block text-sm font-medium text-gray-700">Category</label>
                        <select name="category_id" id="category_id"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50">
                            <option value="">Pick a Category</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ old('category_id', $internship->category_id) == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="language_id" class="block text-sm font-medium text-gray-700">Language</label>
                        <select name="language_id" id="language_id"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50">
                            <option value="">Pick a Language</option>
                            @foreach ($languages as $language)
                                <option value="{{ $language->id }}"
                                    {{ old('language_id', $internship->language_id) == $language->id ? 'selected' : '' }}>
                                    {{ $language->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('language_id')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="year_level_id" class="block text-sm font-medium text-gray-700">Year Level</label>
                        <select name="year_level_id" id="year_level_id"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50">
                            <option value="">Pick a Year Level</option>
                            @foreach ($yearLevels as $yearLevel)
                                <option value="{{ $yearLevel->id }}"
                                    {{ old('year_level_id', $internship->year_level_id) == $yearLevel->id ? 'selected' : '' }}>
                                    {{ $yearLevel->level }}
                                </option>
                            @endforeach
                        </select>
                        @error('year_level_id')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="salary" class="block text-sm font-medium text-gray-700">Salary</label>
                        <input type="number" name="salary" id="salary"
                               class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50"
                               value="{{ old('salary', $internship->salary) }}" required>
                        @error('salary')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="techstack" class="block text-sm font-medium text-gray-700">Tech Stack</label>
                        <div class="grid grid-cols-2 gap-4">
                            @foreach ($technologies as $technology)
                                <label class="inline-flex items-center">
                                    <input type="checkbox" name="techstack[]"
                                           value="{{ $technology->id }}"
                                           class="form-checkbox h-5 w-5 text-gray-600"
                                        {{ in_array($technology->id, old('techstack', $internship->technologies->pluck('id')->toArray())) ? 'checked' : '' }}>
                                    <span class="ml-2 text-gray-700">{{ $technology->name }}</span>
                                </label>
                            @endforeach
                        </div>
                        @error('techstack')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="passed" class="block text-sm font-medium text-gray-700">Passed</label>
                        <input type="checkbox" name="passed" id="passed"
                               class="mt-1 h-5 w-5 text-gray-600"
                            {{ old('passed', $internship->passed) ? 'checked' : '' }}>
                        @error('passed')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex justify-end">
                        <x-primary-button type="submit"
                                class="bg-purple-500 hover:bg-purple-700">
                            Update Internship
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-main-dashboard-user>
