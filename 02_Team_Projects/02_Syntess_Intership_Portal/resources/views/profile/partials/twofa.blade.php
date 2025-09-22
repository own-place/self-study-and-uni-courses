<section class="space-y-6">
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Two Factor Authentication') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __('Two factor authentication enhances your account\'s protection. By enabling it, everytime you log in you will be sent an email with a code, which will be required to access the site. You can choose to enable or disable it') }}
        </p>
    </header>

    <div class="flex items-center gap-4">
        <form action="{{route('manage.2fa', $user)}}" method="post">
            @csrf
            @method('put')
            <x-primary-button>{{ ($user->has2fa) ? __('Disable') : __('Enable') }}</x-primary-button>
        </form>

        @if (session('status') === '2fa_changed')
            <p
                x-data="{ show: true }"
                x-show="show"
                x-transition
                x-init="setTimeout(() => show = false, 2000)"
                class="text-sm text-gray-600 dark:text-gray-400"
            >{{ __('Saved.') }}</p>
        @endif
    </div>
</section>
