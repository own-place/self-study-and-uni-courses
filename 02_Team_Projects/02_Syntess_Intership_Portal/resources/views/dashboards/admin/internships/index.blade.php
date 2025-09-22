<x-main-dashboard-user>
    <div class="p-4 sm:ml-64 flex mt-10 flex-wrap">
        <div class="w-full lg:grid lg:grid-cols-2 lg:gap-10 m-6">
            <div class="lg:col-span-2">
                @if (session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4"
                         role="alert">
                        <span class="block sm:inline">{{ session('success') }}</span>
                    </div>
                @endif

                <div class="mb-4">
                    <a href="{{ route('admin.internships.create') }}"
                       class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                        Create New Internship
                    </a>
                </div>

                <div class="max-w-2/3 overflow-x-auto">
                    <table class="min-w-full bg-white overflow-hidden rounded-lg shadow-md">
                        <thead>
                        <tr class="bg-gray-200">
                            <th class="px-6 py-3 border-b-2 border-gray-300 text-left text-xs font-semibold uppercase tracking-wide">
                                Title
                            </th>
                            <th class="px-6 py-3 border-b-2 border-gray-300 text-left text-xs font-semibold uppercase tracking-wider w-2/3">
                                Description
                            </th>
                            <th class="px-6 py-3 border-b-2 border-gray-300 text-left text-xs font-semibold uppercase tracking-tighter">
                                Language
                            </th>
                            <th class="px-6 py-3 border-b-2 border-gray-300 text-left text-xs font-semibold uppercase tracking-tighter">
                                Category
                            </th>
                            <th class="px-6 py-3 border-b-2 border-gray-300 text-left text-xs font-semibold uppercase tracking-tighter">
                                Year Level
                            </th>
                            <th class="px-6 py-3 border-b-2 border-gray-300"></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($internships as $internship)
                            <tr class="hover:bg-gray-100">
                                <td class="px-6 py-4 whitespace-wrap break-words">{{ $internship->title }}</td>
                                <td class="px-6 py-4 whitespace-wrap break-words">{{ $internship->description }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $internship->language->name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $internship->category->name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $internship->yearLevel->level }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium flex flex-wrap justify-center">
                                    <form action="{{ route('admin.internships.show', $internship->id) }}" method="GET" class="inline ml-2 mb-2">
                                        @csrf
                                        <x-primary-button type="submit">View</x-primary-button>
                                    </form>
                                    <form action="{{ route('admin.internships.edit', $internship->id) }}" method="GET" class="inline ml-2 mb-2">
                                        @csrf
                                        <x-primary-button type="submit" class="bg-purple-600 hover:bg-purple-900">Edit</x-primary-button>
                                    </form>
                                    <form action="{{ route('admin.internships.destroy', $internship->id) }}" method="POST" class="inline ml-2 mb-2"
                                          onsubmit="return confirm('Are you sure you want to delete this internship?')">
                                        @csrf
                                        @method('DELETE')
                                        <x-primary-button type="submit" class="bg-red-600 hover:bg-red-900">Delete</x-primary-button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div class="mt-4">
                        {{ $internships->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-main-dashboard-user>
