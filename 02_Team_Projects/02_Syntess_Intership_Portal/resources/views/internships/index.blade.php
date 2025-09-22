<x-main-before-logging>
    <div class="mx-auto max-w-7xl px-6 lg:px-8 mt-12">
        <div class="mx-auto lg:mx-0">
            <h2 class="text-3xl font-bold tracking-tight text-black sm:text-4xl">Our internships availabilities</h2>
            <p class="mt-2 text-lg leading-8 text-gray-800">Welcome to our comprehensive internship portal, your gateway to a world of exciting and diverse internship opportunities. Here, you can browse through all our internships that are currently available or have been proposed as assignments. Our platform is designed to connect students and recent graduates with valuable hands-on experiences in various fields from the technology sector. Start your journey towards a rewarding professional experience today by exploring the wide array of internships we have to offer.</p>
        </div>

        <div class="bg-white mt-4">
            <form id="filter-form" class="mb-8 bg-white p-6 rounded-lg shadow-lg">
                <h3 class="text-lg font-semibold mb-4 text-gray-900">Filter Internships</h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    <div>
                        <label for="category" class="block text-sm font-medium text-gray-700">Category</label>
                        <select id="category" name="category" class="mt-1 block w-full pl-3 pr-10 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            <option value="">Select Category</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label for="year_level" class="block text-sm font-medium text-gray-700">Year Level</label>
                        <select id="year_level" name="year_level" class="mt-1 block w-full pl-3 pr-10 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            <option value="">Select Year Level</option>
                            @foreach($yearLevels as $yearLevel)
                                <option value="{{ $yearLevel->id }}" {{ request('year_level') == $yearLevel->id ? 'selected' : '' }}>{{ $yearLevel->level }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="relative inline-block w-full text-gray-700">
                        <label for="tech_stack" class="block text-sm font-medium text-gray-700">Technology Stack</label>
                        <div class="relative">
                            <button type="button" id="tech_stack" class="text-left mt-1 block w-full pl-3 pr-10 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:border-2 sm:text-sm">
                                Select Technology Stack
                            </button>
                            <div class="absolute mt-1 w-full rounded-md bg-white shadow-lg z-10 hidden" id="tech-stack-dropdown">
                                <div class="py-1 overflow-auto max-h-60">
                                    @foreach($technologies as $technology)
                                        <label class="flex items-center p-2 cursor-pointer hover:bg-gray-100">
                                            <input type="checkbox" class="form-checkbox h-4 w-4 text-indigo-600" value="{{ $technology->name }}" name="tech_stack[]"
                                                {{ in_array($technology->name, (array)request('tech_stack', [])) ? 'checked' : '' }}>
                                            <span class="ml-2 text-gray-700">{{ $technology->name }}</span>
                                        </label>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="relative inline-block w-full text-gray-700">
                        <label for="language" class="block text-sm font-medium text-gray-700">Language</label>
                        <div class="relative">
                            <button type="button" id="language" class="text-left mt-1 block w-full pl-3 pr-10 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:border-2 sm:text-sm">
                                Select Language
                            </button>
                            <div class="absolute mt-1 w-full rounded-md bg-white shadow-lg z-10 hidden" id="language-dropdown">
                                <div class="py-1 overflow-auto max-h-60">
                                    @foreach($languages as $language)
                                        <label class="flex items-center p-2 cursor-pointer hover:bg-gray-100">
                                            <input type="checkbox" class="form-checkbox h-4 w-4 text-indigo-600" value="{{ $language->id }}" name="language[]"
                                                {{ in_array($language->id, (array)request('language', [])) ? 'checked' : '' }}>
                                            <span class="ml-2 text-gray-700">{{ $language->name }}</span>
                                        </label>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-4 relative">
                        <label for="min_salary" class="block text-sm font-medium text-gray-700">Minimum Salary</label>
                        <div id="tooltip" class="absolute bg-gray-700 text-white text-xs rounded py-1 px-2 opacity-0 transition-opacity duration-300 ease-in-out transform -translate-y-8 z-10">
                            0
                        </div>
                        <input type="range" id="min_salary" name="min_salary" min="0" value="0" max="1000" step="1" class="mt-1 block w-full appearance-none bg-gray-300 rounded-lg h-2 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-all duration-300 ease-in-out">
                        <div class="flex justify-between text-sm text-gray-500 mt-2">
                                <span class="absolute" style="left: 0%; transform: translateX(-50%);">0</span>
                                <span class="absolute" style="left: 25%; transform: translateX(-50%);">250</span>
                                <span class="absolute" style="left: 50%; transform: translateX(-50%);">500</span>
                                <span class="absolute" style="left: 75%; transform: translateX(-50%);">750</span>
                                <span class="absolute" style="left: 100%; transform: translateX(-50%);">1000</span>
                        </div>
                    </div>
                    <div>
                        <label for="sort_by" class="block text-sm font-medium text-gray-700">Sort By</label>
                        <select id="sort_by" name="sort_by" class="mt-1 block w-full pl-3 pr-10 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            <option value="">Select Sort By</option>
                            <option value="lowest_salary">Lowest Salary</option>
                            <option value="highest_salary">Highest Salary</option>
                        </select>
                    </div>
                </div>
            </form>
            <div id="internship-list" class="grid grid-cols-1 gap-x-8 gap-y-10 lg:grid-cols-3">
                @include('internships.partials.internship_list', ['internships' => $internships])
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.getElementById('min_salary').addEventListener('input', function (event) {
                const value = event.target.value;
                const tooltip = document.getElementById('tooltip');
                tooltip.textContent = value;
                tooltip.style.left = `calc(${value / 10}% - 16px)`;
                tooltip.style.opacity = 1;
                document.getElementById('min_salary_value').textContent = 'Selected: ' + value;
            });

            document.getElementById('min_salary').addEventListener('mouseout', function () {
                document.getElementById('tooltip').style.opacity = 0;
            });

            // Toggle dropdown for tech stack
            const dropdownButton = document.querySelector('#tech_stack');
            const dropdown = document.querySelector('#tech-stack-dropdown');

            dropdownButton.addEventListener('click', function () {
                dropdown.classList.toggle('hidden');
            });

            document.addEventListener('click', function (event) {
                if (!dropdownButton.contains(event.target) && !dropdown.contains(event.target)) {
                    dropdown.classList.add('hidden');
                }
            });

            const checkboxes = dropdown.querySelectorAll('input[type="checkbox"]');
            checkboxes.forEach(function (checkbox) {
                checkbox.addEventListener('change', function () {
                    const selected = [];
                    checkboxes.forEach(function (box) {
                        if (box.checked) {
                            selected.push(box.value);
                        }
                    });
                    dropdownButton.innerText = selected.join(', ') || 'Select Technology Stack';
                });
            });

            // Toggle dropdown for language
            const langDropdownButton = document.querySelector('#language');
            const langDropdown = document.querySelector('#language-dropdown');

            langDropdownButton.addEventListener('click', function () {
                langDropdown.classList.toggle('hidden');
            });

            document.addEventListener('click', function (event) {
                if (!langDropdownButton.contains(event.target) && !langDropdown.contains(event.target)) {
                    langDropdown.classList.add('hidden');
                }
            });

            const langCheckboxes = langDropdown.querySelectorAll('input[type="checkbox"]');
            langCheckboxes.forEach(function (checkbox) {
                checkbox.addEventListener('change', function () {
                    const selected = [];
                    langCheckboxes.forEach(function (box) {
                        if (box.checked) {
                            selected.push(box.nextElementSibling.innerText);
                        }
                    });
                    langDropdownButton.innerText = selected.join(', ') || 'Select Language';
                });
            });
        });

        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            function filterData() {
                $.ajax({
                    url: '{{ route('internships.search') }}',
                    type: 'GET',
                    data: $('#filter-form').serialize(),
                    success: function(data) {
                        $('#internship-list').html(data);
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                        alert('An error occurred while fetching internships.');
                    }
                });
            }

            $('#filter-form').on('change', function() {
                filterData();
            });

            if (window.location.search) {
                filterData();
            }
        });

    </script>
</x-main-before-logging>
