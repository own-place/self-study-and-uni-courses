<x-guest-layout>
    <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
        {{ __('The code has been sent to your email.') }}
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('verify.2fa', $user) }}">
        @csrf

        <!-- Code -->
        <div>
            <x-input-label for="code" :value="__('Code:')" />
            <x-text-input id="code" class="block mt-1 w-full" type="text" name="code" :value="old('code')" placeholder="XXXXXX" required autofocus />
            <x-input-error :messages="$errors->get('code')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button>
                {{ __('Check') }}
            </x-primary-button>
        </div>
    </form>
    <form action="{{route('resend.2fa', $user)}}" method="post">
        @csrf
        <div class="flex items-center justify-end mt-4">
            <x-primary-button>
                {{ __('Resend Code') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
