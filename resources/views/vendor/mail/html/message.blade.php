@component('mail::layout')
    {{-- Header --}}
    @slot('header')
        @component('mail::header', ['url' => config('app.url')])
            <img src="{{ asset('images/email_site-logo.png') }}" alt="Securtac Logo" width="75">
        @endcomponent
    @endslot

    {{-- Body --}}
    {{ $slot }}

    {{-- Sign --}}
    {{-- Subcopy --}}
    @isset($sign)
        @slot('sign')
            
        @endslot
    @endisset

    {{-- Subcopy --}}
    @isset($subcopy)
        @slot('subcopy')
            @component('mail::subcopy')
                {{ $subcopy }}
            @endcomponent
        @endslot
    @endisset

    {{-- Footer --}}
    @slot('footer')
        @component('mail::footer')
            © {{ date('Y') }} {{ 'Securtac Protection Services Inc.' }}. @lang('All rights reserved.')
        @endcomponent
    @endslot
@endcomponent
