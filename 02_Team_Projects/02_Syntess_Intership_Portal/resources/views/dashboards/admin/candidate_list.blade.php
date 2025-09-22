@php
    use App\Models\User;
    use App\Models\Role;
    use App\Models\Application;
    $unreviewedCandidates = Application::whereNull('admin_approval')->with('user')->get();
    $reviewedCandidates = Application::whereNotNull('admin_approval')->with('user')->get();
    $finalDecisionCandidates = Application::where('current_step', 3)->with('user')->get();
@endphp

<x-main-dashboard-user>
    <div class="p-4 sm:ml-64 flex mt-10 flex-wrap">
        <div class="w-full lg:grid lg:grid-cols-3 lg:gap-10 m-6">
            <div class="lg:col-span-2">
                <div class="bg-gradient-to-r from-purple-500 to-purple-700 shadow-lg rounded-lg p-4 mx-auto lg:mx-0 flex items-center justify-center mb-4 text-white border-4 border-purple-600">
                    <div class="text-center px-6">
                        <h2 class="text-2xl font-bold">CANDIDATES</h2>
                        <p class="mt-2">View a list of all candidates and the according step through their application! Pay attention
                        to the ones in the SHOW UNREVIEWED section as they are waiting for your initial review, and those in the WAITING FOR FINAL DECISION section
                        as they are excited to hear from you after your interview together!</p>
                    </div>
                </div>

                {{-- Toggle buttons --}}
                <div class="mb-4 flex space-x-2">
                    <x-primary-button id="showUnreviewed" class="mr-2 bg-purple-500 hover:bg-purple-700 text-white">Show
                        Unreviewed
                    </x-primary-button>
                    <x-primary-button id="showReviewed" class="mr-2 bg-gray-500 hover:bg-purple-500 text-white">Show
                        Reviewed
                    </x-primary-button>
                    <x-primary-button id="showFinalDecision" class="bg-gray-500 hover:bg-purple-500 text-white">Waiting
                        for Final Decision
                    </x-primary-button>
                </div>

                {{-- Unreviewed Candidates --}}
                <ul id="unreviewedList" class="divide-y divide-gray-100">
                    @foreach($unreviewedCandidates as $application)
                        @if($application->user->role_id == Role::CANDIDATE)
                            <li class="flex justify-between gap-x-6 py-5">
                                <div class="flex items-center space-x-4 w-2/3"> <!-- Adjusted width -->
                                    <img class="h-12 w-12 flex-none rounded-full bg-gray-50"
                                         src="{{ $application->user->photo ? Storage::url($application->user->photo) : 'https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80' }}"
                                         alt="">
                                    <div class="flex-auto">
                                        <p class="text-sm font-semibold leading-6 text-gray-900">{{ $application->user->full_name }}</p>
                                        <p class="mt-1 truncate text-xs leading-5 text-gray-500">{{ $application->user->email }}</p>
                                        <p class="text-sm leading-6 text-gray-900">Candidate</p>
                                    </div>
                                    <form action="{{ route('review.user', $application->user->id) }}" method="GET">
                                        @csrf
                                        <x-primary-button type="submit">Review Application</x-primary-button>
                                    </form>
                                </div>
                            </li>
                        @endif
                    @endforeach
                </ul>

                {{-- Reviewed Candidates --}}
                <ul id="reviewedList" class="divide-y divide-gray-100 hidden">
                    @foreach($reviewedCandidates as $application)
                        @if($application->user->role_id == Role::CANDIDATE)
                            <li class="flex justify-between gap-x-6 py-5">
                                <div class="flex items-center space-x-4 w-2/3"> <!-- Adjusted width -->
                                    <img class="h-12 w-12 flex-none rounded-full bg-gray-50"
                                         src="{{ $application->user->photo ? Storage::url($application->user->photo) : 'https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80' }}"
                                         alt="">
                                    <div class="flex-auto">
                                        <p class="text-sm font-semibold leading-6 text-gray-900">{{ $application->user->full_name }}</p>
                                        <p class="mt-1 truncate text-xs leading-5 text-gray-500">{{ $application->user->email }}</p>
                                        <p class="text-sm leading-6 text-gray-900">Candidate</p>
                                    </div>
                                    <form action="{{ route('review.user', $application->user->id) }}" method="GET">
                                        @csrf
                                        <x-primary-button type="submit">Review Application</x-primary-button>
                                    </form>
                                </div>
                            </li>
                        @endif
                    @endforeach
                </ul>

                {{-- Candidates Waiting for Final Decision --}}
                <ul id="finalDecisionList" class="divide-y divide-gray-100 hidden">
                    @foreach($finalDecisionCandidates as $application)
                        @if($application->user->role_id == Role::CANDIDATE)
                            <li class="flex justify-between gap-x-6 py-5">
                                <div class="flex items-center space-x-4 w-2/3"> <!-- Adjusted width -->
                                    <img class="h-12 w-12 flex-none rounded-full bg-gray-50"
                                         src="{{ $application->user->photo ? Storage::url($application->user->photo) : 'https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80' }}"
                                         alt="">
                                    <div class="flex-auto">
                                        <p class="text-sm font-semibold leading-6 text-gray-900">{{ $application->user->full_name }}</p>
                                        <p class="mt-1 truncate text-xs leading-5 text-gray-500">{{ $application->user->email }}</p>
                                        <p class="text-sm leading-6 text-gray-900">Candidate</p>
                                    </div>
                                    <form action="{{ route('review.user', $application->user->id) }}" method="GET">
                                        @csrf
                                        <x-primary-button type="submit">Review Application</x-primary-button>
                                    </form>
                                    <x-primary-button onclick="openFinalChoiceModal({{ $application->user->id }})">Final
                                        Choice
                                    </x-primary-button>
                                </div>
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

    {{-- Final Choice Modal --}}
    <div id="finalChoiceModal" class="fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-75 hidden">
        <div class="bg-white p-6 rounded-lg shadow-lg w-96">
            <h3 class="text-xl font-bold mb-4">Final Choice Confirmation</h3>

            {{-- Form for Reject --}}
            <form id="rejectForm" method="POST"
                  action="{{ route('final.choice', ['userId' => 'userId', 'choice' => 0]) }}">
                @csrf
                <div id="finalChoiceContentModalReject">
                    Do you want to reject this candidate's application?
                </div>
                <div class="mt-4 flex justify-end space-x-2">
                    <x-primary-button type="submit" class="bg-red-500 hover:bg-red-600">Reject</x-primary-button>
                </div>
            </form>

            {{-- Form for Accept --}}
            <form id="acceptForm" method="POST"
                  action="{{ route('final.choice', ['userId' => 'userId', 'choice' => 1]) }}">
                @csrf
                <div id="finalChoiceContentModalAccept">
                    Or do you want to accept this candidate to be an intern at Syntess?
                </div>
                <div class="mt-4 flex justify-end space-x-2">
                    <x-primary-button type="submit" class="bg-green-500 hover:bg-green-600">Accept</x-primary-button>
                    <x-primary-button type="button" onclick="closeFinalChoiceModal()">Close</x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-main-dashboard-user>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const showUnreviewedButton = document.getElementById('showUnreviewed');
        const showReviewedButton = document.getElementById('showReviewed');
        const showFinalDecisionButton = document.getElementById('showFinalDecision');
        const unreviewedList = document.getElementById('unreviewedList');
        const reviewedList = document.getElementById('reviewedList');
        const finalDecisionList = document.getElementById('finalDecisionList');
        const finalChoiceForm = document.getElementById('finalChoiceForm');
        const finalChoiceInput = document.getElementById('finalChoice');
        let selectedUserId = null;

        showUnreviewedButton.addEventListener('click', function () {
            unreviewedList.classList.remove('hidden');
            reviewedList.classList.add('hidden');
            finalDecisionList.classList.add('hidden');
            showUnreviewedButton.classList.add('bg-purple-500', 'hover:bg-purple-700');
            showUnreviewedButton.classList.remove('bg-gray-500');
            showReviewedButton.classList.add('bg-gray-500');
            showReviewedButton.classList.remove('bg-purple-500', 'hover:bg-purple-700');
            showFinalDecisionButton.classList.add('bg-gray-500');
            showFinalDecisionButton.classList.remove('bg-purple-500', 'hover:bg-purple-700');
        });

        showReviewedButton.addEventListener('click', function () {
            unreviewedList.classList.add('hidden');
            reviewedList.classList.remove('hidden');
            finalDecisionList.classList.add('hidden');
            showReviewedButton.classList.add('bg-purple-500', 'hover:bg-purple-700');
            showReviewedButton.classList.remove('bg-gray-500');
            showUnreviewedButton.classList.add('bg-gray-500');
            showUnreviewedButton.classList.remove('bg-purple-500', 'hover:bg-purple-700');
            showFinalDecisionButton.classList.add('bg-gray-500');
            showFinalDecisionButton.classList.remove('bg-purple-500', 'hover:bg-purple-700');
        });

        showFinalDecisionButton.addEventListener('click', function () {
            unreviewedList.classList.add('hidden');
            reviewedList.classList.add('hidden');
            finalDecisionList.classList.remove('hidden');
            showFinalDecisionButton.classList.add('bg-purple-500', 'hover:bg-purple-700');
            showFinalDecisionButton.classList.remove('bg-gray-500');
            showUnreviewedButton.classList.add('bg-gray-500');
            showUnreviewedButton.classList.remove('bg-purple-500', 'hover:bg-purple-700');
            showReviewedButton.classList.add('bg-gray-500');
            showReviewedButton.classList.remove('bg-purple-500', 'hover:bg-purple-700');
        });
    });

    function openFinalChoiceModal(userId) {
        document.getElementById('finalChoiceModal').classList.remove('hidden');
        document.getElementById('rejectForm').action = "{{ route('final.choice', ['userId' => 'userId', 'choice' => 0]) }}".replace('userId', userId);
        document.getElementById('acceptForm').action = "{{ route('final.choice', ['userId' => 'userId', 'choice' => 1]) }}".replace('userId', userId);
    }

    function openAcceptForm(userId) {
        document.getElementById('acceptForm').style.display = 'block';
        document.getElementById('rejectForm').style.display = 'none';
        document.getElementById('finalChoiceContentModalAccept').innerText = "Are you sure you want to accept this candidate to be an intern at Syntess?";
        document.getElementById('acceptForm').action = "{{ route('final.choice', ['userId' => 'userId', 'choice' => 1]) }}".replace('userId', userId);
    }

    function closeFinalChoiceModal() {
        document.getElementById('finalChoiceModal').classList.add('hidden');
    }
</script>
