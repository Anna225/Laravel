@component('mail::message')
# Hello {{ $data->first_name.' '.$data->last_name}},

##Congratulations, You have completed all the chapters you can proceed with Final Quiz.


@component('mail::sign')
    @slot('site_logo')
        <img src="{{ asset('images/email_site-logo.png') }}" alt="Securtac Logo" width="50">
    @endslot

    @slot('facebook_img')
        <img src="{{ asset('images/email_facebook.png') }}" alt="Facebook Logo" width="24">
    @endslot

    @slot('instagram_img')
        <img src="{{ asset('images/email_instagram.png') }}" alt="Instagram Logo" width="24">
    @endslot

    1691 McCowan Rd. Unit 101 <br>
    Toronto, Ontario <br>
    M1S 2Y3 <br>
    Tel: 416-479-0056<br>
    <a href="https://securtac.ca">www.securtac.ca</a>
@endcomponent
@endcomponent
