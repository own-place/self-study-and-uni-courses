@php
use App\Models\Role;
@endphp

<x-main-dashboard-user>
    <div class="p-4 sm:ml-64 flex mt-10 flex-wrap">
        <div class="w-full lg:grid lg:grid-cols-3 lg:gap-10 m-6">
            <div class="lg:col-span-2">
                <div class="bg-gradient-to-r from-purple-500 to-purple-700 shadow-lg rounded-lg p-4 mx-auto lg:mx-0 flex items-center justify-center mb-4 text-white border-4 border-purple-600">
                    <div class="text-center px-6">
                        <h2 class="text-2xl font-bold">CANDIDATES</h2>
                        <p class="mt-2">View a list of all candidates' applications that are assigned to you!</p>
                    </div>
                </div>

                {{-- Toggle buttons --}}
                <div class="mb-4 flex space-x-2">
                    <x-primary-button id="showUnreviewed" class="mr-2 bg-purple-500 hover:bg-purple-700 text-white">Show Unreviewed</x-primary-button>
                    <x-primary-button id="showReviewed" class="bg-gray-500 hover:bg-purple-500 text-white">Show Reviewed</x-primary-button>
                </div>

                {{-- Unreviewed Candidates --}}
                <ul id="unreviewedList" class="divide-y divide-gray-100">
                    @foreach($unreviewedCandidates as $application)
                        @if($application->user->role_id == Role::CANDIDATE)
                            <li class="flex justify-between gap-x-6 py-5">
                                <div class="flex gap-x-4">
                                    <img class="h-12 w-12 flex-none rounded-full bg-gray-50"
                                         src="{{ $application->user->photo ? Storage::url($application->user->photo) : 'https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80' }}"
                                         alt="">
                                    <div class="flex-auto">
                                        <p class="text-sm font-semibold leading-6 text-gray-900">{{ $application->user->full_name }}</p>
                                        <p class="mt-1 truncate text-xs leading-5 text-gray-500">{{ $application->user->email }}</p>
                                        <p class="text-sm leading-6 text-gray-900">Candidate</p>
                                    </div>
                                </div>
                                <form action="{{ route('mentor.review', $application->user->id) }}" method="GET">
                                    @csrf
                                    <x-primary-button type="submit">Review Application</x-primary-button>
                                </form>
                            </li>
                        @endif
                    @endforeach
                </ul>

                {{-- Reviewed Candidates --}}
                <ul id="reviewedList" class="divide-y divide-gray-100 hidden">
                    @foreach($reviewedCandidates as $application)
                        @if($application->user->role_id == Role::CANDIDATE)
                            <li class="flex justify-between gap-x-6 py-5">
                                <div class="flex gap-x-4">
                                    <img class="h-12 w-12 flex-none rounded-full bg-gray-50"
                                         src="{{ $application->user->photo ? Storage::url($application->user->photo) : 'https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80' }}"
                                         alt="">
                                    <div class="flex-auto">
                                        <p class="text-sm font-semibold leading-6 text-gray-900">{{ $application->user->full_name }}</p>
                                        <p class="mt-1 truncate text-xs leading-5 text-gray-500">{{ $application->user->email }}</p>
                                        <p class="text-sm leading-6 text-gray-900">Candidate</p>
                                    </div>
                                </div>
                                <form action="{{ route('mentor.review', $application->user->id) }}" method="GET">
                                    @csrf
                                    <x-primary-button type="submit">Review Application</x-primary-button>
                                </form>
                            </li>
                        @endif
                    @endforeach
                </ul>
            </div>

            <!-- Calendar Section -->
            <div class="flex w-full lg:w-auto rounded-lg">
                <x-calendar></x-calendar>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const showUnreviewedButton = document.getElementById('showUnreviewed');
            const showReviewedButton = document.getElementById('showReviewed');
            const unreviewedList = document.getElementById('unreviewedList');
            const reviewedList = document.getElementById('reviewedList');

            showUnreviewedButton.addEventListener('click', function() {
                unreviewedList.classList.remove('hidden');
                reviewedList.classList.add('hidden');
                showUnreviewedButton.classList.add('bg-purple-500', 'hover:bg-purple-700');
                showUnreviewedButton.classList.remove('bg-gray-500');
                showReviewedButton.classList.add('bg-gray-500');
                showReviewedButton.classList.remove('bg-purple-500', 'hover:bg-purple-700');
            });

            showReviewedButton.addEventListener('click', function() {
                unreviewedList.classList.add('hidden');
                reviewedList.classList.remove('hidden');
                showReviewedButton.classList.add('bg-purple-500', 'hover:bg-purple-700');
                showReviewedButton.classList.remove('bg-gray-500');
                showUnreviewedButton.classList.add('bg-gray-500');
                showUnreviewedButton.classList.remove('bg-purple-500', 'hover:bg-purple-700');
            });
        });
    </script>
</x-main-dashboard-user>
