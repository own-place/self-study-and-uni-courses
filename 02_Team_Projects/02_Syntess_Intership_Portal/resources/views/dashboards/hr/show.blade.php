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
                        @if($application->admin_approval === true)
                            <span class="text-green-500">Accepted</span>
                        @elseif($application->admin_approval === false)
                            <span class="text-red-500">Rejected</span>
                        @endif
                    </div>
                </div>
            </div>

            <!-- otherwise it returns an error -->
            @foreach($documents as $document) @endforeach

            <div class="bg-white shadow-lg rounded-lg p-4 mx-auto lg:mx-0 flex items-center justify-between mb-4">
                <div class="text">
                    <p class="text-xl font-bold text-gray-900">Check his/her submitted documents:</p><br>
                    <p class="text-gray-500 underline underline-offset-8">
                        <a href="{{ route('download.cv',$document) }}"
                           class="inline-flex items-center px-4 py-2 bg-red-500 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                            CV
                        </a>
                    </p><br>
                    <p class="text-gray-500 underline underline-offset-8">
                        <a href="{{ route('download.resume',$document) }}"
                           class="inline-flex items-center px-4 py-2 bg-red-500 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                            Resume
                        </a>
                    </p><br>
                    <p class="text-gray-500 underline underline-offset-8">
                        <a href="{{ route('download.enrollment',$document) }}"
                           class="inline-flex items-center px-4 py-2 bg-red-500 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                            Enrolment Letter
                        </a>
                    </p><br>

                    <p class="text-gray-600 text-sm">* Click the buttons to download the documents!</p>
                </div>
            </div>

            <!-- Display Admin's Answer -->
            <div class="bg-white shadow-lg rounded-lg p-4 mx-auto lg:mx-0 flex items-center justify-between mb-4">
                <div class="text">
                    <p class="text-lg font-semibold text-gray-900 mb-2">Admin's Answer:</p>
                    @if($application->admin_approval === 1)
                        <span class="text-green-500">Accepted</span>
                    @elseif($application->admin_approval === 0)
                        <span class="text-red-500">Rejected</span>
                    @else
                        <span class="text-gray-600">No answer provided</span>
                    @endif
                </div>
            </div>

            <!-- Display Mentor Assigned -->
            <div class="bg-white shadow-lg rounded-lg p-4 mx-auto lg:mx-0 flex items-center justify-between mb-4">
                <div class="text">
                    <h2 class="text-lg font-semibold text-gray-900 mb-2">This application has been forwarded to this
                        mentor:</h2>
                    @if($assignedMentor)
                        <div class="pb-4">
                            <div>
                                <p class="text-gray-700"><span
                                        class="font-semibold">Name:</span> {{ $assignedMentor->first_name }} {{ $assignedMentor->last_name }}
                                </p>
                                <p class="text-gray-700"><span
                                        class="font-semibold">Email:</span> {{ $assignedMentor->email }}</p>
                            </div>
                        </div>
                    @else
                        <p class="text-gray-600">No mentor assigned yet.</p>
                    @endif
                </div>
            </div>

            <!-- Display Mentor's Answer -->
            <div class="bg-white shadow-lg rounded-lg p-4 mx-auto lg:mx-0 flex items-center justify-between mb-4">
                <div class="text">
                    <p class="text-lg font-semibold text-gray-900 mb-2">Mentor's Answer:</p>
                    @if($application->mentor_approval === 1)
                        <span class="text-green-500">Accepted</span>
                    @elseif($application->mentor_approval === 0)
                        <span class="text-red-500">Rejected</span>
                    @else
                        <span class="text-gray-600">No answer provided</span>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-main-dashboard-user>
