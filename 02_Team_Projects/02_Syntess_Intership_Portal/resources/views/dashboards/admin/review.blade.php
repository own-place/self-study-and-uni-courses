@php
use App\Models\User;
@endphp

<x-main-dashboard-user>
    <div class="p-4 sm:ml-64 flex mt-10 flex-wrap">
        <div class="w-full lg:gap-10 m-6">
            <div class="bg-white shadow-lg rounded-lg p-4 mx-auto lg:mx-0 flex items-center justify-between mb-4">
                <div class="text">
                    <h2 class="text-2xl font-bold text-gray-900 mb-4">Application Details</h2>
                    <div class="pb-4">
                        <p class="text-lg font-semibold text-gray-900 mb-2">Candidate Information</p>
                        <div>
                            <p class="text-gray-700"><span
                                    class="font-semibold">Name:</span> {{ $application->user->first_name }} {{ $application->user->last_name }}
                            </p>
                            <p class="text-gray-700"><span
                                    class="font-semibold">Email:</span> {{ $application->user->email }}</p>
                        </div>
                        @if(isset($application->preference))
                            <p class="text-gray-600"><span
                                    class="font-semibold">Preference:</span> {{ $application->preference }}</p>
                        @else
                            <p class="text-gray-600">No preference provided</p>
                        @endif
                    </div>
                </div>
            </div>

            <!-- otherwise it returns an error -->
            @foreach($documents as $document) @endforeach

            <div class="bg-white shadow-lg rounded-lg p-4 mx-auto lg:mx-0 flex items-center justify-between mb-4">
                <div class="text">
                    <p class="text-xl font-bold text-gray-900">{{__('Check his/ her submitted documents:')}}</p><br>
                    <p class="text-gray-500 underline underline-offset-8">
                        <a href="{{route('download.cv',$document)}}" class="inline-flex items-center px-4 py-2 bg-red-500 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                            {{__('CV')}}
                        </a>
                    </p><br>
                    <p class="text-gray-500 underline underline-offset-8">
                        <a href="{{route('download.resume',$document)}}" class="inline-flex items-center px-4 py-2 bg-red-500 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                            {{__('Resume')}}
                        </a>
                    </p><br>
                    <p class="text-gray-500 underline underline-offset-8">
                        <a href="{{route('download.enrollment',$document)}}" class="inline-flex items-center px-4 py-2 bg-red-500 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                            {{__('Letter of Enrollment')}}
                        </a>
                    </p><br>
                    <p class="text-gray-600 text-sm">* {{__('Click the buttons to download the documents!')}}</p>
                </div>
            </div>

            @if($application->admin_approval == NULL)
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                    <div class="col-span-1">
                        <div class="bg-white shadow-lg rounded-lg p-6 mx-auto lg:mx-0 mb-4">
                            <div class="text">
                                <h2 class="text-lg font-semibold text-gray-900 mb-2">Leave a comment:</h2>
                                <form action="{{ route('comments.store') }}" method="POST">
                                    @csrf
                                    <div class="mb-4">
                                        <input type="hidden" name="application_id" value="{{ $application->id }}">
                                        <textarea name="comment"
                                                  class="w-full p-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500"
                                                  rows="4" placeholder="Write your comment here..."></textarea>
                                        <x-input-error :messages="$errors->get('comment')"/>
                                    </div>
                                    <div class="flex justify-end">
                                        <x-primary-button type="submit" class="px-6 py-2">Save</x-primary-button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-span-1">
                        <div class="bg-white shadow-lg rounded-lg p-6 mx-auto lg:mx-0 mb-4">
                            <div class="text">
                                <h2 class="text-lg font-semibold text-gray-900 mb-2">Latest comment:</h2>
                                @if($latestComment)
                                    <p class="text-gray-600 text-sm mb-2">Created at: {{$latestComment->created_at}}</p>
                                    <p class="text-gray-800 mb-4">{{$latestComment->comment}}</p>
                                @else
                                    <p class="text-gray-600">No comments yet.</p>
                                @endif
                                <div class="flex justify-end">
                                    <a href="{{ route('comments.index') }}"
                                       class="inline-flex items-center px-4 py-2 bg-gray-400 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                                        <strong>{{__('View the previous comments')}}</strong>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white shadow-lg rounded-lg p-4 mx-auto lg:mx-0 flex items-center justify-between mb-4">
                    <div class="text">
                        <h2 class="text-lg font-semibold text-gray-900 mb-2">For this application, you would like
                            to:</h2>
                        <p class="text-gray-600 text-sm mb-4">* You have an overview of the mentors who might be
                            appropriate
                            to assign to the candidate! Pick wisely to be able to accept or reject the application and
                            forward it to the mentor</p>
                        <p>
                            <!-- Review Form -->
                        <form action="{{ route('review.user', $application->user->id) }}" method="GET">
                            @csrf

                            <x-primary-button type="button" onclick="showMentorMatches({{ $application->user->id }})">
                                View Mentor Recommendations
                            </x-primary-button>

                            <div class="relative inline-block">
                                <x-primary-button type="button" onclick="toggleAssignMentor()">Assign Mentor
                                </x-primary-button>
                                <div id="assignMentorDropdown"
                                     class="absolute hidden bg-white shadow-lg rounded-md py-1 mt-2">
                                    @foreach($mentors as $mentor)
                                        <button type="button"
                                                class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                                                onclick="selectMentor({{ $mentor->id }}, '{{ $mentor->first_name }} {{ $mentor->last_name }}')">
                                            {{ $mentor->first_name }} {{ $mentor->last_name }}
                                        </button>
                                    @endforeach
                                </div>
                            </div>
                            <x-primary-button type="submit" id="assignMentorButton" class="hidden">Assign Mentor
                            </x-primary-button>
                        </form>

                        <div id="selectedMentorName" class="mt-2 mb-4"></div>

                        <form
                            action="{{ route('admin.accept', ['id' => $application->id, 'mentorId' => $mentor->id]) }}"
                            method="POST" id="acceptForm">
                            @csrf
                            <input type="hidden" name="mentor_id" id="selectedMentorId">
                            <x-primary-button type="submit" id="acceptButton" class="bg-green-500 hidden">
                                Accept
                            </x-primary-button>
                        </form>
                        <form
                            action="{{ route('admin.reject', ['id' => $application->id, 'mentorId' => $mentor->id]) }}"
                            method="POST" id="rejectForm">
                            @csrf
                            <input type="hidden" name="mentor_id" id="selectedMentorIdReject">
                            <x-primary-button type="submit" id="rejectButton" class="bg-red-500 hidden">
                                Reject
                            </x-primary-button>
                        </form>

                        <div id="mentorMatchesModal"
                             class="fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-75 hidden">
                            <div class="bg-white p-6 rounded-lg shadow-lg w-96">
                                <h3 class="text-xl font-bold mb-4">Recommended Mentors</h3>
                                <div id="mentorMatchesContentModal"></div>
                                <button class="mt-4 px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600"
                                        onclick="closeMentorMatches()">Close
                                </button>
                            </div>
                        </div>
                        @else
                            <div class="pb-4">
                                <h2 class="text-lg font-semibold text-gray-900 mb-2">This application has been forwarded to this mentor:</h2>
                                <div>
                                    @if($assignedMentor)
                                        <div class="pb-4">
                                            <div>
                                                <p class="text-gray-700"><span class="font-semibold">Name:</span> {{ $assignedMentor->first_name }} {{ $assignedMentor->last_name }}</p>
                                                <p class="text-gray-700"><span class="font-semibold">Email:</span> {{ $assignedMentor->email }}</p>
                                            </div>
                                        </div>
                                    @else
                                        <p class="text-gray-600">No mentor assigned yet.</p>
                                    @endif
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
        </div>
    </div>

    <script>
        function toggleAssignMentor() {
            document.getElementById('assignMentorDropdown').classList.toggle('hidden');
        }

        function selectMentor(mentorId, mentorName) {
            document.getElementById('selectedMentorId').value = mentorId;
            document.getElementById('selectedMentorIdReject').value = mentorId;
            document.getElementById('assignMentorDropdown').classList.add('hidden');
            document.getElementById('selectedMentorName').innerText = `Selected Mentor: ${mentorName}`;
            document.getElementById('acceptButton').classList.remove('hidden');
            document.getElementById('rejectButton').classList.remove('hidden');
        }

        function showMentorMatches(userId) {
            fetch(`/admin/student/${userId}/recommended`)
                .then(response => response.json())
                .then(data => {
                    let html = '<ul class="divide-y divide-gray-100">';
                    if (data.matches.length > 0) {
                        data.matches.forEach(match => {
                            const mentor = match.mentor;
                            const commonHobbies = Array.isArray(match.common_hobbies) ? match.common_hobbies : [];
                            const percentage = match.percentage.toFixed(2);

                            html += `
                        <li class="flex gap-x-4 py-5">
                            <img class="h-12 w-12 flex-none rounded-full bg-gray-50"
                                src="${mentor.photo ? `/storage/${mentor.photo}` : 'https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80'}"
                                alt="">
                            <div class="flex-auto">
                                <p class="text-sm font-semibold leading-6 text-gray-900">${mentor.first_name} ${mentor.last_name}</p>
                                <p class="mt-1 text-xs leading-5 text-gray-500">Match: ${percentage}%</p>
                                <p class="text-sm leading-6 text-gray-900">This mentor also likes:</p>
                                <ul class="list-disc pl-5">`;
                            commonHobbies.forEach(hobby => {
                                html += `<li>${hobby}</li>`;
                            });
                            html += `
                                </ul>
                            </div>
                        </li>`;
                        });
                    } else {
                        html = '<p>No matching mentors</p>';
                    }
                    document.getElementById('mentorMatchesContentModal').innerHTML = html;
                    document.getElementById('mentorMatchesModal').classList.remove('hidden');
                })
                .catch(error => {
                    console.error('Error fetching recommendations:', error);
                });
        }

        function closeMentorMatches() {
            document.getElementById('mentorMatchesContentModal').innerHTML = '';
            document.getElementById('mentorMatchesModal').classList.add('hidden');
        }
    </script>
</x-main-dashboard-user>
