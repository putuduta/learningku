@component('mail::message')
    # Hello

    Your Payment has been confirmed
    Please use this account:

    Email: {{ $email }}
    Password: {{ $password }}

    Thanks,
    {{ config('app.name') }}
@endcomponent
