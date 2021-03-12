@extends('layouts.app')

@section('title')
    Book Now - {{ $service->name }}     
@endsection

@section('content')
<div class="insite-content">
    <div class="site-part">
        <div class="container">
            <div class="sec-title">
                <h1>{{ $service->name }}</h1>
            </div>
            <table class="table table-responsive-sm mt-4 min-table">
                <thead>
                    <tr>
                        <th scope="col">Event</th>
                        <th scope="col">Venue</th>
                        <th scope="col">Start Date</th>
                        <th scope="col">Start Time</th>
                        <th scope="col">End Date</th>
                        <th scope="col">Book Now</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($scheduleSlots as $slot)
                        <tr>
                            <td>{{ $slot->event }}</td>
                            <td>{{ $slot->venue }}</td>
                            <td>{{ date('d-m-Y', strtotime($slot->start_date)) }}</td>
                            <td>{{ $slot->start_time }}</td>
                            <td>{{ date('d-m-Y', strtotime($slot->end_date)) }}</td>
                            <td>
                                @if ( $bookedSlotId == $slot->id )
                                    <span class="badge badge-success">Booked</span></td>
                                @elseif( ! $bookedSlotId )
                                    <a href="#" class="booknow-link" data-slot="{{ $slot->id }}">Book Now</a>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="5">There are no slots available right now.</td></tr>
                    @endforelse
                </tbody>
            </table>
            @if ( $bookedSlotId )
                <div class="row">                        
                    <div class="col-md-12 text-center">
                        <div class="alert alert-info mt-4" role="alert">
                            <strong> Contact administrator for any changes of submitted schedule appointment.</strong>
                        </div>
                        <button class="btn btn-primary mw130 contact-support">Contact  <i class="fas fa-fw fa-envelope"></i></button>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

@section('footer_scripts')
<script>
$(document).ready(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('.booknow-link').click(function(e){
        var slot_id     = $(this).attr('data-slot');
        e.preventDefault();

        Swal.fire({
            title: 'Confirm Your Booking',
            type: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Book',
            showLoaderOnConfirm:true,
            preConfirm: () => {
                var headers = {
                    "Content-Type": "application/json",                                                                                                
                    "Access-Control-Origin": "*",
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
                return fetch(`{{ route('schedule.action') }}`,{
                    method: "POST",
                    headers: headers,
                    body:  JSON.stringify({slot_id: slot_id})
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error(response.statusText)
                    }
                    return response.json()
                })
                .catch(error => {
                    Swal.showValidationMessage(
                    `Request failed: ${error}`
                    )
                })
            },
            allowOutsideClick: () => !Swal.isLoading()
        }).then((result) => {
            console.log(result);
            if ( result.value.status == 'success' ) {
                Swal.fire({
                    title: 'Success.',
                    type: 'success',
                    text: 'Your appointment created'
                }).then((result) => {
                    window.location.reload();
                });
            } else {
                Swal.fire(
                    'Error',
                    'Something went wrong.',
                    'error'
                )
            }
        })
    });

    $('.contact-support').click(function(e){
        e.preventDefault();
        Swal.fire({
            title: 'Enter Your Message',
            //text:'User details with automatically attached with message.',
            input: 'textarea',
            showCancelButton: true,
            confirmButtonText: 'Send',
            showLoaderOnConfirm: true,
            inputAutoTrim: false,
            inputValidator: (value) => {
                if (!value) {
                    return 'Please enter your message'
                }
            },
            preConfirm: (message) => {
                var headers = {
                    "Content-Type": "application/json",                                                                                                
                    "Access-Control-Origin": "*",
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
                return fetch(`{{ route('contact_admin') }}`,{
                    method: "POST",
                    headers: headers,
                    body:  JSON.stringify({ message: `${message}` })
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error(response.statusText)
                    }
                    return response.json()
                })
                .catch(error => {
                    Swal.showValidationMessage(
                    `Request failed: ${error}`
                    )
                })
            },
            allowOutsideClick: () => !Swal.isLoading()
        }).then((result) => {
            console.log(result.value.status);
            if (result.value.status == 'success') {
                Swal.fire({
                    type: 'success',
                    title: 'Success',
                    text: result.value.msg,
                })
            }
        })
    });

    @if ($message = Session::get('success'))
        Swal.fire({
            type: 'success',
            title: 'Success',
            text: '{{ $message }}',
        })
    @endif

    @if ($message = Session::get('error'))
        Swal.fire({
            type: 'error',
            title: 'Error',
            text: '{{ $message }}',
        })
    @endif
});

</script>
@endsection
