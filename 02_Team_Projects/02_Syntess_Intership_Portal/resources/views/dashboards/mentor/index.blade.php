@php
    use App\Models\MentorMessage;use App\Models\User;
    use App\Models\Role;
@endphp
<x-main-dashboard-user>
    <div class="p-4 sm:ml-64 flex mt-10 flex-wrap">
        <div class="w-full lg:grid lg:grid-cols-3 lg:gap-10 m-6">
            <div class="lg:col-span-2">
                <div class="bg-gradient-to-r from-purple-500 to-purple-700 shadow-lg rounded-lg p-4 mx-auto lg:mx-0 flex items-center justify-center mb-4 text-white border-4 border-purple-600">
                    <div class="text-center px-6">
                        <h2 class="text-2xl font-bold">Welcome, <em>Mentor {{ Auth::user()->first_name }}!</em></h2>
                        <p class="mt-2">Good job with keeping this portal up to date!</p>
                    </div>
                    <div class="mt-4 mix-blend-luminosity">
                        <img src="{{ asset('images/LP_main_photo.png') }}" alt="Welcome Image" class="h-48 object-cover">
                    </div>
                </div>

                <!-- Statistics -->
                <x-statistics-numbers gridClass="cols"/>

                <x-quote-of-the-day/>

                {{--hobbies quiz--}}
                <div id="hobbySection" class="mb-6 border-l-4 border-purple-500 bg-purple-50 p-4 flex items-center">
                    <i class="fas fa-exclamation-circle text-purple-500 mr-3"></i>
                    <div>
                        <p class="mb-2 text-purple-700 font-semibold">Take the quiz to help our internship coordinator
                            connect you with the best interns! :)</p>
                        <x-primary-button type="button" class="bg-purple-500 hover:bg-purple-200" onclick="openModal()">
                            Hobby Quiz
                        </x-primary-button>
                    </div>
                </div>

                <div id="quizModal"
                     class="fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-75 hidden">
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
                            <x-secondary-button type="button" onclick="closeModal()">Close</x-secondary-button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Calendar Section -->
            <div class="flex w-full lg:w-auto rounded-lg flex flex-wrap">
                <x-calendar></x-calendar>
            </div>
        </div>
    </div>

    <script>
        function openModal() {
            document.getElementById('quizModal').classList.remove('hidden');
        }

        function closeModal() {
            document.getElementById('quizModal').classList.add('hidden');
        }
    </script>
</x-main-dashboard-user>
