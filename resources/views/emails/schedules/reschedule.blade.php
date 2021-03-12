@component('mail::message')
# Hello {{ $data->user->name }}, 

Below are the new details of the course. Cancellations or date changes are subject to the Refund Policy. For any inquries please email us at info@securtac.ca or call us at 416-479-0056

### New Schedule Details:
@component('mail::table')
|             |                        |
|-------------|------------------------|
|**Event**| {{ $data->schedule_slot->event }} |
|**Venue**| {{ $data->schedule_slot->venue }} |
| **Start Date** | {{ date('d-m-Y',strtotime($data->schedule_slot->start_date)) }} |
| **End Date** | {{ date('d-m-Y',strtotime($data->schedule_slot->end_date)) }} |
@endcomponent


Thanks,<br>
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
