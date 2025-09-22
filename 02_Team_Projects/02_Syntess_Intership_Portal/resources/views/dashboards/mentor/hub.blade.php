@php
    use App\Models\MentorMessage;use App\Models\User;
    use App\Models\Role;
@endphp
<x-main-dashboard-user>
    <div class="p-4 sm:ml-64 flex flex-col mt-10">
        <h2 class="text-lg font-semibold text-gray-800 mb-3 mt-5">Mentor's HUB</h2>
        <p class="text-sm text-gray-600 mb-3">This is the place to discuss possible assignments/internships with all other mentors.</p>
        <div class="lg:w-auto bg-purple-400 rounded-lg h-[600px] lg:h-[73vh] flex flex-col justify-between mb-1 relative">
            <div class="overflow-y-auto p-4" id="hub">
                <!-- Messages -->
                @foreach(MentorMessage::query()->orderBy('created_at', 'desc')->get()->take(10)->reverse() as $message)
                    @if(auth()->id() !== $message->user_id)
                        <div class="flex flex-col gap-4 mb-3 w-full">
                            <div class="flex items-start gap-2.5">
                                <img class="w-8 h-8 rounded-full"
                                     src="{{ ($message->mentor->photo) ? Storage::url($message->mentor->photo) : 'https://flowbite.com/docs/images/people/profile-picture-5.jpg' }}"
                                     alt="User image">
                                <div class="bg-purple-200 rounded-md p-3">
                                    <div class="flex items-center space-x-2 rtl:space-x-reverse">
                                        <span
                                            class="font-semibold text-gray-900 dark:text-white">{{ $message->mentor->full_name }}</span>
                                        <span
                                            class="text-sm text-gray-500 dark:text-gray-400">{{ $message->created_at->format('l \, h:i A') }}</span>
                                    </div>
                                    <p class="text-sm py-2 text-gray-900 dark:text-white">{{ $message->content }}</p>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="flex flex-col gap-4 mb-6 w-full items-end">
                            <div class="flex items-end gap-2.5">
                                <div class="bg-purple-200 rounded-md p-3">
                                    <div class="flex items-center space-x-2 rtl:space-x-reverse">
                                        <span
                                            class="font-semibold text-gray-900 dark:text-white">{{ $message->mentor->full_name }}</span>
                                        <span
                                            class="text-sm text-gray-500 dark:text-gray-400">{{ $message->created_at->format('l \, h:i A') }}</span>
                                    </div>
                                    <p class="text-sm py-2 text-gray-900 dark:text-white">{{ $message->content }}</p>
                                </div>
                                <img class="w-8 h-8 rounded-full"
                                     src="{{ ($message->mentor->photo) ? Storage::url($message->mentor->photo) : 'https://flowbite.com/docs/images/people/profile-picture-5.jpg' }}"
                                     alt="User image">
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
            <!-- Chat input -->
            <form class="flex justify-end items-center w-full p-4" id="chat">
                @csrf
                <div class="field flex-auto">
                    <div class="control">
                                <textarea id="text"
                                          class="block w-full px-4 py-2 rounded-md bg-white border border-gray-300 focus:outline-none focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                          name="content" required placeholder="Type your message..."
                                          rows="3"></textarea>
                    </div>
                </div>
                <x-primary-button id="post" class="ml-5">Send</x-primary-button>
            </form>
        </div>
        <p id="err" class="text-sm text-red-600 dark:text-red-400 space-y-1 invisible">Message exceeded 100
            characters!</p>
    </div>

    <script type="module">
        const user = '{{ strtolower(auth()->user()->full_name) }}';

        Echo.channel('Chat')
            .listen('Message', (e) => {
                const outDiv = document.createElement('div');
                outDiv.className = (e.message.sender !== user) ? 'flex flex-col gap-4 mb-6 w-full' : 'flex flex-col gap-4 mb-6 w-full items-end';

                const innerdiv = document.createElement('div');
                innerdiv.className = (e.sender !== user) ? 'flex items-start gap-2.5' : 'flex items-end gap-2.5';

                const img = document.createElement('img');
                img.className = 'w-8 h-8 rounded-full';
                img.src = (e.message.photo) ? `http://127.0.0.1:8000/storage/${e.message.photo}` : 'https://flowbite.com/docs/images/people/profile-picture-5.jpg';
                img.alt = 'User_photo';

                const divAfterImg = document.createElement('div');
                divAfterImg.className = 'bg-purple-200 rounded-md p-3';

                const secondInnerDiv = document.createElement('div');
                secondInnerDiv.className = 'flex items-center space-x-2 rtl:space-x-reverse';

                const fSpan = document.createElement('span');
                fSpan.className = 'font-semibold text-gray-900 dark:text-white';
                fSpan.textContent = e.message.fullname;

                const sSpan = document.createElement('span');
                sSpan.className = 'text-sm text-gray-500 dark:text-gray-400';
                sSpan.textContent = e.message.created_at;

                const p = document.createElement('p');
                p.className = 'text-sm py-2 text-gray-900 dark:text-white';
                p.textContent = e.message.content;

                secondInnerDiv.appendChild(fSpan);
                secondInnerDiv.appendChild(sSpan);

                divAfterImg.appendChild(secondInnerDiv);
                divAfterImg.appendChild(p);

                if (e.message.sender === user) {
                    innerdiv.appendChild(divAfterImg);
                    innerdiv.appendChild(img);
                } else {
                    innerdiv.appendChild(img);
                    innerdiv.appendChild(divAfterImg);
                }

                outDiv.appendChild(innerdiv);

                document.getElementById('hub').appendChild(outDiv);
            });

        const form = document.getElementById('chat');
        if (form !== undefined && form !== null) {
            form.addEventListener('submit', function (e) {
                e.preventDefault();
                const input = document.getElementById('text');
                const value = input.value;
                input.value = '';
                fetch('{{ route('post.message') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({content: value})
                }).then(response => response.json())
                    .catch(() => {
                            const p = document.getElementById('err');
                            p.classList.remove('invisible');
                            setTimeout(function () {
                                p.classList.add('invisible');
                            }, 3000);
                        }
                    );
            });
        }
    </script>

</x-main-dashboard-user>
