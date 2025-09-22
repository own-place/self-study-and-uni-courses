@php
    use App\Models\Role;
@endphp

<x-main-dashboard-user>
    <div class="p-4 sm:ml-64 flex mt-10 flex-wrap">
        <div class="w-full lg:grid lg:grid-cols-3 lg:gap-10 m-6">
            <div class="lg:col-span-2">
                <div class="bg-gradient-to-r from-purple-500 to-purple-700 shadow-lg rounded-lg p-4 mx-auto lg:mx-0 flex items-center justify-center mb-4 text-white border-4 border-purple-600">
                    <div class="text-center px-6">
                        <h2 class="text-2xl font-bold">APPLICATIONS</h2>
                        <p class="mt-2">View a list of all candidates' applications at any stage of their application! Pay attention as to when you need to
                        fill in a schedule form for the interview and the contract stage!</p>
                    </div>
                </div>

                {{-- Toggle buttons --}}
                <div class="mb-4 flex space-x-2">
                    <x-primary-button id="showNotApproved" class="mr-2 bg-purple-500 hover:bg-purple-700 text-white">Not
                        Approved
                    </x-primary-button>
                    <x-primary-button id="showWaitingForScheduling"
                                      class="mr-2 bg-gray-500 hover:bg-purple-500 text-white">Waiting for Scheduling
                    </x-primary-button>
                    <x-primary-button id="showScheduled" class="mr-2 bg-gray-500 hover:bg-purple-500 text-white">
                        Scheduled
                    </x-primary-button>
                    <x-primary-button id="showWaitingForContract" class="bg-gray-500 hover:bg-purple-500 text-white">
                        Waiting for Contract
                    </x-primary-button>
                </div>

                {{-- Not Approved Candidates --}}
                <ul id="notApprovedList" class="divide-y divide-gray-100">
                    @foreach($notApprovedCandidates as $application)
                        @if($application->user->role_id == Role::CANDIDATE)
                            <li class="flex justify-between gap-x-6 py-5">
                                <div class="flex items-center space-x-4 w-2/3">
                                    <img class="h-12 w-12 flex-none rounded-full bg-gray-50"
                                         src="{{ $application->user->photo ? Storage::url($application->user->photo) : 'https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80' }}"
                                         alt="">
                                    <div class="flex-auto">
                                        <p class="text-sm font-semibold leading-6 text-gray-900">{{ $application->user->full_name }}</p>
                                        <p class="mt-1 truncate text-xs leading-5 text-gray-500">{{ $application->user->email }}</p>
                                        <p class="text-sm leading-6 text-gray-900">Candidate</p>
                                    </div>
                                    <form action="{{ route('hr.show', $application->id) }}" method="GET">
                                        @csrf
                                        <x-primary-button type="submit">View Application</x-primary-button>
                                    </form>
                                </div>
                            </li>
                        @endif
                    @endforeach
                </ul>

                {{-- Waiting for Scheduling Candidates --}}
                <ul id="waitingForSchedulingList" class="divide-y divide-gray-100 hidden">
                    @foreach($waitingForSchedulingCandidates as $application)
                        @if($application->user->role_id == Role::CANDIDATE)
                            <li class="flex justify-between gap-x-6 py-5">
                                <div class="flex items-center space-x-4 w-2/3">
                                    <img class="h-12 w-12 flex-none rounded-full bg-gray-50"
                                         src="{{ $application->user->photo ? Storage::url($application->user->photo) : 'https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80' }}"
                                         alt="">
                                    <div class="flex-auto">
                                        <p class="text-sm font-semibold leading-6 text-gray-900">{{ $application->user->full_name }}</p>
                                        <p class="mt-1 truncate text-xs leading-5 text-gray-500">{{ $application->user->email }}</p>
                                        <p class="text-sm leading-6 text-gray-900">Candidate</p>
                                    </div>
                                    <form action="{{ route('hr.show', $application->user->id) }}" method="GET">
                                        @csrf
                                        <x-primary-button type="submit">View Application</x-primary-button>
                                    </form>
                                    <x-primary-button onclick="openSchedulingModal('{{ $application->id }}', '{{ $assignedMentor->mentor->id }}', '{{ $application->user_id }}')">Schedule Interview</x-primary-button>
                                </div>
                            </li>
                        @endif
                    @endforeach
                </ul>

                {{-- Scheduled Candidates --}}
                <ul id="scheduledList" class="divide-y divide-gray-100 hidden">
                    @foreach($scheduledCandidates as $application)
                        @if($application->user->role_id == Role::CANDIDATE)
                            <li class="flex justify-between gap-x-6 py-5">
                                <div class="flex items-center space-x-4 w-2/3">
                                    <img class="h-12 w-12 flex-none rounded-full bg-gray-50"
                                         src="{{ $application->user->photo ? Storage::url($application->user->photo) : 'https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80' }}"
                                         alt="">
                                    <div class="flex-auto">
                                        <p class="text-sm font-semibold leading-6 text-gray-900">{{ $application->user->full_name }}</p>
                                        <p class="mt-1 truncate text-xs leading-5 text-gray-500">{{ $application->user->email }}</p>
                                        <p class="text-sm leading-6 text-gray-900">Candidate</p>
                                    </div>
                                    <form action="{{ route('hr.show', $application->user->id) }}" method="GET">
                                        @csrf
                                        <x-primary-button type="submit">View Application</x-primary-button>
                                    </form>
                                    <span class="bg-green-500 text-white px-6 py-4 rounded">Scheduled</span>
                                </div>
                            </li>
                        @endif
                    @endforeach
                </ul>

                {{-- Waiting for Contract Candidates --}}
                <ul id="waitingForContractList" class="divide-y divide-gray-100 hidden">
                    @foreach($waitingForContractCandidates as $application)
                        @if($application->user->role_id == Role::INTERN)
                            <li class="flex justify-between gap-x-6 py-5">
                                <div class="flex items-center space-x-4 w-2/3">
                                    <img class="h-12 w-12 flex-none rounded-full bg-gray-50"
                                         src="{{ $application->user->photo ? Storage::url($application->user->photo) : 'https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80' }}"
                                         alt="">
                                    <div class="flex-auto">
                                        <p class="text-sm font-semibold leading-6 text-gray-900">{{ $application->user->full_name }}</p>
                                        <p class="mt-1 truncate text-xs leading-5 text-gray-500">{{ $application->user->email }}</p>
                                        <p class="text-sm leading-6 text-gray-900">Candidate</p>
                                    </div>
                                    <form action="{{ route('hr.show', $application->id) }}" method="GET">
                                        @csrf
                                        <x-primary-button type="submit">Review Application</x-primary-button>
                                    </form>
                                    <x-primary-button onclick="openContractModal('{{ $application->id }}')">Add Contract</x-primary-button>
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

    <!-- Schedule Interview Modal -->
    <div id="scheduleModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
        <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
            </div>

            <div class="inline-block align-middle bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:max-w-lg sm:w-full">
                <form id="scheduleForm" action="{{ route('interviews.schedule') }}" method="POST">
                    @csrf
                    <div class="bg-white px-4 py-5 sm:px-6">
                        <div class="text-center">
                            <h3 class="text-lg font-medium text-gray-900">Schedule Interview</h3>
                        </div>
                        <div class="mt-5">
                            <input type="hidden" name="application_id" id="applicationId">
                            <input type="hidden" name="mentor_id" id="mentorId">
                            <input type="hidden" name="candidate_id" id="candidateId">
                            <input type="hidden" name="admin_id" id="adminId">

                            <div class="mb-4">
                                <label for="date" class="block text-sm font-medium text-gray-700">Date:</label>
                                <input type="date" id="date" name="date" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required min="{{ now()->format('Y-m-d') }}">
                            </div>

                            <div class="mb-4">
                                <label for="time" class="block text-sm font-medium text-gray-700">Time:</label>
                                <input type="time" id="time" name="time" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                        <button type="submit" class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-purple-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-purple-700 focus:outline-none focus:border-purple-700 focus:ring-2 focus:ring-purple-500 sm:ml-3 sm:w-auto sm:text-sm">
                            Schedule
                        </button>
                        <button type="button" onclick="closeSchedulingModal()" class="inline-flex justify-center w-full rounded-md border border-gray-300 px-4 py-2 bg-white text-base leading-6 font-medium text-gray-700 shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:ring-2 focus:ring-blue-200 sm:ml-3 sm:w-auto sm:text-sm">
                            Cancel
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Contract Modal --}}
    <div id="contractModal" class="fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-50 hidden">
        <div class="bg-white p-6 rounded shadow-lg">
            <h3 class="text-lg font-semibold mb-4">Upload Contract</h3>
            <form id="contractForm" action="{{ route('contracts.store', ['id' => $application->id]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-4">
                    <label for="contract_document" class="block text-sm font-medium text-gray-700">Contract Document</label>
                    <x-input-label for="cv" :value="__('Supported file types: pdf, doc, docx')" class="mb-2 italic font-bold text-xs"/>
                    <input type="file" name="contract_document" id="contract_document" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                </div>
                <div class="mb-4">
                    <label for="start_date" class="block text-sm font-medium text-gray-700">Start Date</label>
                    <input type="date" name="start_date" id="start_date" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                </div>
                <div class="mb-4">
                    <label for="end_date" class="block text-sm font-medium text-gray-700">End Date</label>
                    <input type="date" name="end_date" id="end_date" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                </div>
                <div class="flex justify-end space-x-4">
                    <x-primary-button type="submit" class="bg-purple-500 hover:bg-purple-700">Upload</x-primary-button>
                    <x-primary-button onclick="closeContractModal()">Close</x-primary-button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            flatpickr('#time', {
                enableTime: true,
                noCalendar: true,
                dateFormat: "H:i",
                minuteIncrement: 15,
                time_24hr: true
            });

            const showNotApprovedButton = document.getElementById('showNotApproved');
            const showWaitingForSchedulingButton = document.getElementById('showWaitingForScheduling');
            const showScheduledButton = document.getElementById('showScheduled');
            const showWaitingForContractButton = document.getElementById('showWaitingForContract');

            const notApprovedList = document.getElementById('notApprovedList');
            const waitingForSchedulingList = document.getElementById('waitingForSchedulingList');
            const scheduledList = document.getElementById('scheduledList');
            const waitingForContractList = document.getElementById('waitingForContractList');

            function toggleActiveButton(activeButton) {
                [showNotApprovedButton, showWaitingForSchedulingButton, showScheduledButton, showWaitingForContractButton].forEach(btn => btn.classList.remove('bg-purple-500'));
                activeButton.classList.add('bg-purple-500', 'text-white');
            }

            function showList(list) {
                [notApprovedList, waitingForSchedulingList, scheduledList, waitingForContractList].forEach(lst => lst.classList.add('hidden'));
                list.classList.remove('hidden');
            }

            showNotApprovedButton.addEventListener('click', function () {
                toggleActiveButton(showNotApprovedButton);
                showList(notApprovedList);
            });

            showWaitingForSchedulingButton.addEventListener('click', function () {
                toggleActiveButton(showWaitingForSchedulingButton);
                showList(waitingForSchedulingList);
            });

            showScheduledButton.addEventListener('click', function () {
                toggleActiveButton(showScheduledButton);
                showList(scheduledList);
            });

            showWaitingForContractButton.addEventListener('click', function () {
                toggleActiveButton(showWaitingForContractButton);
                showList(waitingForContractList);
            });

            let dateInput = document.getElementById('date');
            let timeInput = document.getElementById('time');

            let today = new Date();
            let day = ("0" + today.getDate()).slice(-2);
            let month = ("0" + (today.getMonth() + 1)).slice(-2);
            let todayDate = today.getFullYear() + "-" + (month) + "-" + (day);
            dateInput.setAttribute('min', todayDate);

            let currentHour = today.getHours();
            timeInput.value = ("0" + currentHour).slice(-2) + ":00";

            document.getElementById('start_date').min = new Date().toISOString().split("T")[0];

            document.getElementById('start_date').addEventListener('change', function() {
                document.getElementById('end_date').min = this.value;
                document.getElementById('end_date').value = '';
            });
        });

        function openSchedulingModal(applicationId, mentorId, candidateId) {
            document.getElementById('applicationId').value = applicationId;
            document.getElementById('mentorId').value = mentorId;
            document.getElementById('candidateId').value = candidateId;
            document.getElementById('adminId').value = {{ $admin->id }};

            document.getElementById('scheduleModal').classList.remove('hidden');
        }

        document.getElementById('scheduleForm').addEventListener('submit', function(event) {
            const timeInput = document.getElementById('time');
            if (!timeInput.value) {
                event.preventDefault();
                alert('Please select a time for the interview.');
            }
        });

        function closeSchedulingModal() {
            document.getElementById('scheduleModal').classList.add('hidden');
        }

        function openContractModal(applicationId) {
            const modal = document.getElementById('contractModal');
            const contractForm = document.getElementById('contractForm');
            contractForm.action = `/contracts/store/${applicationId}`;
            modal.classList.remove('hidden');
        }

        function closeContractModal() {
            const modal = document.getElementById('contractModal');
            modal.classList.add('hidden');
        }
    </script>
</x-main-dashboard-user>
