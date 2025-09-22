@php
    use Carbon\Carbon;
    use Illuminate\Support\Facades\Auth;
@endphp

<div class="bg-white shadow-lg rounded-lg p-4 mx-auto lg:mx-0 mb-4">
    <h2 class="text-2xl font-bold text-gray-900 mb-4">Application Tracking</h2>
    <ol class="relative border-l border-gray-200 dark:border-gray-700">
        @php
            $steps = [
                    ['title' => 'Application Submitted', 'time' => 'immediately after submission', 'description' => 'Your application has been submitted successfully.'],
                    ['title' => 'Initial Review', 'time' => 'between 1-3 weeks', 'description' => 'Your application is going to being reviewed by our team - our internship coordinator and your possible future mentor.'],
                    ['title' => 'Interview Scheduled', 'time' => 'between 1-2 weeks', 'description' => 'You have been scheduled for an interview.']
                ];

                if(Auth::user()->application && Auth::user()->application->current_step >= 2 && Auth::user()->application->interview) {
                    $interviewDateTime = Carbon::parse(Auth::user()->application->interview->date . ' ' . Auth::user()->application->interview->time);
                    $formattedDateTime = $interviewDateTime->isoFormat('MMMM Do YYYY, h:mm a');
                    $steps[] = ['title' => 'Interview', 'time' => 'at ' . $formattedDateTime, 'description' => 'You have been interviewed.'];
                } else {
                    $steps[] = ['title' => 'Interview', 'time' => '1 hour', 'description' => 'You have been interviewed.'];
                }

                $steps[] = ['title' => 'Final Decision', 'time' => 'around 2 weeks', 'description' => 'You will receive the final decision on your application.'];
                $currentStep = Auth::user()->application->current_step ?? 0;
        @endphp

        @foreach ($steps as $index => $step)
            <li class="mb-10 ml-6">
                <span
                    class="absolute flex items-center justify-center w-6 h-6 rounded-full -left-3 ring-8 ring-white dark:ring-gray-900 {{ $index <= $currentStep ? 'bg-green-500' : 'bg-gray-200 dark:bg-gray-700' }}">
                    <svg class="w-3 h-3 text-white" fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11h3a1 1 0 010 2h-3v3a1 1 0 01-2 0v-3H6a1 1 0 010-2h3V6a1 1 0 012 0v3z"/>
                    </svg>
                </span>
                <h3 class="flex items-center mb-1 text-lg font-semibold {{ $index <= $currentStep ? 'text-green-500 dark:text-green-500' : 'text-gray-900 dark:text-white' }}">{{ $step['title'] }}</h3>
                <time
                    class="block mb-2 text-sm font-normal {{ $index <= $currentStep ? 'text-green-400 dark:text-green-500' : 'text-gray-400 dark:text-gray-500' }} leading-none">{{ $step['time'] }}</time>
                <p class="text-base font-normal border border-3 p-3 rounded-lg text-gray-800 {{ $index <= $currentStep ? 'bg-green-100' : 'bg-gray-100'}} ">{{ $step['description'] }}</p>
            </li>
        @endforeach
    </ol>
</div>
