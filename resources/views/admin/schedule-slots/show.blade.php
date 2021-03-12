@extends('admin.layouts.app')

@section('title')
    Schedule Slot Details
@endsection

@section('header_scripts')        
    <link rel="stylesheet" href="{{ URL::asset('plugins/sweetalert2/sweetalert2.min.css') }}">
@endsection

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <a href="{{ route('admin.slots.index', $scheduleSlot->service_id) }}">Back</a>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active"><a href="{{ route('admin.slots.index', $scheduleSlot->service_id) }}">Schedule Slots</a></li>
                        <li class="breadcrumb-item active">View</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div style="margin-bottom: 10px;" class="row">
                <div class="col-lg-12">
                    <a class="btn btn-primary pull-right" href="{{ route('admin.slots.edit', $scheduleSlot->id) }}">
                        Edit Slot
                    </a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-7">
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <th>Service </th>
                                <td>
                                    {{ $scheduleSlot->service->name }}
                                </td>
                            </tr>
                            <tr>
                                <th>Event </th>
                                <td>
                                    {{ $scheduleSlot->event }}
                                </td>
                            </tr>
                            <tr>
                                <th>Venue </th>
                                <td>
                                    {{ $scheduleSlot->venue }}
                                </td>
                            </tr>
                            <tr>
                                <th>Start Date </th>
                                <td>
                                    {{ $scheduleSlot->start_date }}
                                </td>
                            </tr>
                            <tr>
                                <th>Start Time </th>
                                <td>
                                    {{ $scheduleSlot->start_time }}
                                </td>
                            </tr>
                            <tr>
                                <th>End Date </th>
                                <td>
                                    {{ $scheduleSlot->end_date }}
                                </td>
                            </tr>
                            <tr>
                                <th>Status </th>
                                <td>
                                    {{ $scheduleSlot->status }}
                                </td>
                            </tr>
                            <tr>
                                <th></th>
                                <td colspan="2">
                                    <a href="#" data-slot="{{ $scheduleSlot->id }}" class="btn btn-success btn-sm add-users">Add Users</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- /.row -->
            <div class="row">
                <h4><strong>Users </strong></h4>
                <div class="col-md-12">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>User</th>
                                <th>User Email</th>
                                <th>User Mobile Number</th>
                                <th>Booking Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($scheduleSlot->user_schedules as $key => $schedule)
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td><a href="{{ route('admin.users.show', $schedule->user->id) }}">{{ $schedule->user->name }}</td>
                                    <td>{{ $schedule->user->email }}</td>
                                    <td>{{ $schedule->user->mobile_number }}</td>
                                    <td>{{ date('d-m-Y', strtotime($schedule->created_at)) }}</td>
                                    <td>
                                        <a href="#" class="delete-slot btn btn-danger btn-sm" title="Delete Slot"><i class="fa-fw fas fa-trash"></i>Delete</a>
                                        <form class="delete-form" action="{{ route('admin.delete.appointment', $schedule->id) }}" method="POST" style="display: inline-block;">
                                            @method('DELETE')
                                            @csrf
                                        </form>
                                    </td>
                                </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center">There are no users booked with this schedule slot.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
@endsection

@section('footer_scripts')
<script src="{{ asset('plugins/sweetalert2/sweetalert2.all.min.js') }}"></script>
<script>
    $(document).ready(function(){
        $('.delete-slot').on('click', function(e){
            e.preventDefault();
            if ( confirm("Are you sure want to delete?") ) {
                $(this).next().submit();
            }
        });

        $('.add-users').click(function(e){
            e.preventDefault();
            var slot_id = $(this).attr('data-slot');

            Swal.fire({
                title: 'Enter email address',
                inputPlaceholder: 'Email address',
                input: 'email',
                showCancelButton: true,
                confirmButtonText: 'Send',
                showLoaderOnConfirm: true,
                inputAutoTrim: false,
                inputValidator: (value) => {
                    if (!value) {
                        return 'Please enter valid email address'
                    }
                },
                preConfirm: (email) => {
                    var headers = {
                        "Content-Type": "application/json",                                                                                                
                        "Access-Control-Origin": "*",
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                    return fetch(`{{ route('admin.schedule.addUser') }}`,{
                        method: "POST",
                        headers: headers,
                        body:  JSON.stringify({ email: `${email}`, slot_id: slot_id })
                    })
                    .then(response => {
                        console.log(response);
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
                if (result.value.status == 'success') {
                    Swal.fire({
                        type: 'success',
                        title: 'Success',
                        text: result.value.msg,
                    }).then((result) => {
                        window.location.reload();
                    });
                } else {
                    Swal.fire({
                        type: 'error',
                        title: 'Error',
                        text: result.value.msg,
                    }).then((result) => {
                        window.location.reload();
                    });
                }
            })
        });
    });
</script>
@endsection