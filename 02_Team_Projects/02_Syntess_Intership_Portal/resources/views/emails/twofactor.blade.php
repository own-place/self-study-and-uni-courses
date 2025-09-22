<x-mail::message>
    # Two Factor Authentication

    Here is your code: {{$code}}

    If you did not initiate this, change your password immediately.

    Sincerely,
    {{ config('app.name') }}
</x-mail::message>
