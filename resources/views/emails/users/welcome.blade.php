@component('mail::message')


    New Company Created.

    @component('mail::button', ['url' => ''])
        Visit Site
    @endcomponent

    Thanks,<br>
    {{ config('app.name') }}
@endcomponent
