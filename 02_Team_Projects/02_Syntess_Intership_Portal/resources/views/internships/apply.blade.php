<x-guest-layout>
    <div class="bg-red-200 p-4 mb-4 mt-4 rounded-md">
        <h1 class="text-xl font-bold text-red-800 mb-2">Internship topic you are applying for: {{ $internship->title }}</h1>
    </div>

    <p class="italic text-center mt-2">Fields marked with * are required</p>
    <form method="POST" action="{{ route('submit.apply.form', $internship) }}" enctype="multipart/form-data">
        @csrf

        <div class="mt-4">
            <x-input-label for="preference" :value="__('Preferences(eg. which language/ environment/ topic would you like to work with?)*')"/>
            <x-textarea-input class="block mt-1 w-full" type="text" name="preference" :value="old('preference')"/>
            <x-input-error :messages="$errors->get('preference')" class="mt-2"/>
        </div>

        <div class="mt-8">
            <x-input-label for="cv" :value="__('CV*')" class="mb-2"/>
            <x-input-label for="cv" :value="__('Supported file types: pdf, doc, docx')" class="mb-2 italic font-bold text-xs"/>
            <input class="rounded-md" type="file" name="cv">
            <x-input-error :messages="$errors->get('cv')" class="mt-2"/>
        </div>

        <div class="mt-8">
            <x-input-label for="resume" :value="__('Resume*')" class="mb-2"/>
            <x-input-label for="cv" :value="__('Supported file types: pdf, doc, docx')" class="mb-2 italic font-bold text-xs"/>
            <input class="rounded-md" type="file" name="resume">
            <x-input-error :messages="$errors->get('resume')" class="mt-2"/>
        </div>

        <div class="mt-8">
            <x-input-label for="letter_of_enrollment" :value="__('Enrolment Letter*')" class="mb-2"/>
            <x-input-label for="cv" :value="__('Supported file types: pdf, doc, docx')" class="mb-2 italic font-bold text-xs"/>
            <input class="rounded-md" type="file" name="letter_of_enrollment">
            <x-input-error :messages="$errors->get('letter_of_enrollment')" class="mt-2"/>
        </div>
        <x-input-label :value="__('Mark this if you wish for a graduation assignment')" class="mt-6 italic font-bold text-xs"/>
        <x-checkbox>Graduation*</x-checkbox>

        <div class="flex-row justify-end align-middle">
            <x-primary-button class="ms-4 mt-7 ml-80">
                {{ __('Submit') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
