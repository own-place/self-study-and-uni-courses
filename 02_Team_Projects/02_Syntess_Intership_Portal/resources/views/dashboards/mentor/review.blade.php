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
                    <p class="text-lg font-semibold text-gray-900 mb-2">Check his/ her submitted documents:</p><br>
                    <p class="text-gray-500 underline underline-offset-8">
                        <a href="{{route('download.cv',$document)}}"
                           class="inline-flex items-center px-4 py-2 bg-red-500 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                            CV/ Resume
                        </a>
                    </p><br>
                    <p class="text-gray-500 underline underline-offset-8">
                        <a href="{{route('download.resume',$document)}}"
                           class="inline-flex items-center px-4 py-2 bg-red-500 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                            Motivation Letter
                        </a>
                    </p><br>
                    <p class="text-gray-500 underline underline-offset-8">
                        <a href="{{route('download.enrollment',$document)}}"
                           class="inline-flex items-center px-4 py-2 bg-red-500 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                            Enrolment Letter
                        </a>
                    </p><br>
                    <p class="text-gray-600 text-sm">* Click the buttons to download the documents!</p>
                </div>
            </div>

            @if ($application->admin_approval !== null && $application->mentor_approval === null)
                <div class="border {{ $application->admin_approval === 1 ? 'border-green-500' : 'border-red-500' }} border-2 shadow-lg rounded-lg p-4 mx-auto lg:mx-0 mb-4">
                    <div class="text mb-4">
                        <h2 class="text-lg font-semibold text-gray-900">Admin's Response:</h2>
                        @if($application->admin_approval === 1)
                            <p class="text-green-500">The Internship Coordinator has ACCEPTED.</p>
                        @else
                            <p class="text-red-500">The Internship Coordinator has REJECTED.</p>
                        @endif
                    </div>

                    <div class="text">
                        @php
                            $adminComments = App\Models\Comment::where('application_id', $application->id)->get();
                        @endphp
                        @if($adminComments->isNotEmpty())
                            @foreach($adminComments as $comment)
                                <div class="mb-4">
                                    <p class="text-gray-600 text-sm mb-2">Created at: {{ $comment->created_at }}</p>
                                    <p class="text-gray-800 mb-4">{{ $comment->comment }}</p>
                                </div>
                            @endforeach
                        @else
                            <p>No comments from the Internship Coordinator.</p>
                        @endif
                    </div>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                    <div class="col-span-1">
                        <div class="bg-white shadow-lg rounded-lg p-6 mx-auto lg:mx-0 mb-4">
                            <div class="text">
                                <h2 class="text-lg font-semibold text-gray-900 mb-2">Leave a comment:</h2>
                                <form action="{{ route('comments.store') }}" method="POST">
                                    @csrf
                                    <div class="mb-4">
                                        <input type="hidden" name="application_id" value="{{ $application->id }}">
                                        <textarea name="comment" class="w-full p-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500" rows="4" placeholder="Write your comment here..."></textarea>
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
                                    <a href="{{ route('comments.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-400 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                                        <strong>View the previous comments</strong>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white shadow-lg rounded-lg p-4 mx-auto lg:mx-0 flex items-center justify-between mb-4">
                    <div class="text">
                        <form action="{{ route('mentor.accept', ['id' => $application->id]) }}" method="POST" id="acceptForm">
                            @csrf
                            <x-primary-button type="submit" class="bg-green-500">
                                Accept
                            </x-primary-button>
                        </form>
                        <form action="{{ route('mentor.reject', ['id' => $application->id]) }}" method="POST" id="rejectForm">
                            @csrf
                            <x-primary-button type="submit" class="bg-red-500">
                                Reject
                            </x-primary-button>
                        </form>
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-main-dashboard-user>
