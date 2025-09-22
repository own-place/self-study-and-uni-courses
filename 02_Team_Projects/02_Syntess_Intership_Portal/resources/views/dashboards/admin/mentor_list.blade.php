@php
    use App\Models\User;
    use App\Models\Role;
@endphp
<x-main-dashboard-user>
    <div class="p-4 sm:ml-64 flex mt-10 flex-wrap">
        <div class="w-full lg:grid lg:grid-cols-3 lg:gap-10 m-6">
            <div class="lg:col-span-2">
                <div class="bg-gradient-to-r from-purple-500 to-purple-700 shadow-lg rounded-lg p-4 mx-auto lg:mx-0 flex items-center justify-center mb-4 text-white border-4 border-purple-600">
                    <div class="text-center px-6">
                        <h2 class="text-2xl font-bold">MENTORS</h2>
                        <p class="mt-2">View a list of all mentors that take care of the interns!</p>
                    </div>
                </div>
                {{-- the users the admin has to verify --}}
                @can('verifyUser', User::class)
                    <ul class="divide-y divide-gray-100">
                        @foreach(User::all() as $user)
                            @if($user->role_id == Role::MENTOR)
                                <li class="flex justify-between gap-x-6 py-5">
                                    <div class="flex gap-x-4">
                                        <img class="h-12 w-12 flex-none rounded-full bg-gray-50"
                                             src="{{ $user->photo ? Storage::url($user->photo) : 'https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80' }}"
                                             alt="">
                                        <div class="flex-auto">
                                            <p class="text-sm font-semibold leading-6 text-gray-900">{{ $user->full_name }}</p>
                                            <p class="mt-1 truncate text-xs leading-5 text-gray-500">{{ $user->email }}</p>
                                            <p class="text-sm leading-6 text-gray-900">Mentor</p>
                                        </div>
                                    </div>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                @endcan
            </div>

            <!-- Calendar Section -->
            <div class="flex w-full lg:w-auto rounded-lg">
                <x-calendar></x-calendar>
            </div>
        </div>
    </div>
</x-main-dashboard-user>
