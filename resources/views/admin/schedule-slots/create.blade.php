@extends('admin.layouts.app')

@section('title')
    Add Schedule Slot
@endsection

@section('header_scripts')
    <link rel="stylesheet" href="{{ asset('plugins/bootstrap-datepicker/bootstrap-datepicker3.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
@endsection

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h4>Add Schedule Slot</h4>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.slots.index', $serviceId) }}">Schedule Slots</a></li>
                        <li class="breadcrumb-item active">Add Slot</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            {{-- @include('admin.partials.flash-message') --}}
            <div class="row">
                <div class="col-md-8">
                    <div class="card card-info">
                        <!-- form start -->
                        <form class="form-horizontal" method="POST" action="{{ route('admin.slots.store', $serviceId) }}">
                            @csrf
                            <div class="card-body">
                                <div class="form-group row">
                                    <label for="input-event" class="col-sm-2 col-form-label">Event</label>
                                    <div class="col-sm-10">
                                        <input name="event" type="text" class="form-control @error('question') is-invalid @enderror" id="input-event" placeholder="Event Name" value="{{ old('event') }}" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="input-venue" class="col-sm-2 col-form-label">Venue</label>
                                    <div class="col-sm-10">
                                        <input name="venue" type="text" class="form-control @error('venue') is-invalid @enderror" id="input-venue" placeholder="Venue Name" value="{{ old('venue') }}" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="input-sdate" class="col-sm-2 col-form-label">Start Date</label>
                                    <div class="col-sm-10">
                                        <input name="start_date" type="text" class="datepicker form-control @error('start_date') is-invalid @enderror" id="input-sdate" placeholder="Start Date" value="{{ old('start_date') }}" autocomplete="off" required>
                                        @error('start_date')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="input-time" class="col-sm-2 col-form-label">Start Time</label>
                                    <div class="col-sm-10">
                                        <div class="date" id="input-time" data-target-input="nearest">
                                            <input type="text" name="start_time" class="form-control" placeholder="Select Time" data-target="#input-time" data-toggle="datetimepicker" autocomplete="off" required>
                                            @error('start_time')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="input-edate" class="col-sm-2 col-form-label">End Date</label>
                                    <div class="col-sm-10">
                                        <input name="end_date" type="text" class="datepicker form-control @error('end_date') is-invalid @enderror" id="input-edate" placeholder="End Date" value="{{ old('end_date') }}" autocomplete="off" required>
                                        @error('end_date')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="input-slots" class="col-sm-2 col-form-label">Total Slots</label>
                                    <div class="col-sm-10">
                                        <input name="total_slots" type="text" class="form-control @error('total_slots') is-invalid @enderror" id="input-slots" placeholder="Total Slots" value="{{ old('total_slots') }}" required>
                                        @error('total_slots')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-10">
                                        <input type="hidden" name="service_id" value="{{ $serviceId }}">
                                        <input type="submit" name="submit" class="btn btn-info" value="Save" />
                                        <input type="submit" name="submit" class="btn btn-info" value="Save and Add another">
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->                            
                        </form>
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
@endsection

@section('footer_scripts')
<script src="{{ asset('plugins/moment/moment.min.js') }}"></script>
<script src="{{ asset('plugins/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ URL::asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
<script>
    $(document).ready(function(){
        var nowDate = new Date();
        var datePickerOptions = {
            startDate: nowDate,
            autoclose: true,
            orientation: "bottom auto",
            format: 'dd-mm-yyyy',
        };
        $('.datepicker').datepicker(datePickerOptions);

        $('#input-time').datetimepicker({
            format: 'LT'
        });

        @if ($message = Session::get('success'))
            toastr.success('{{ $message }}')
        @endif

        @if ($message = Session::get('error'))
            toastr.error('{{ $message }}')
        @endif
    });
    $(document).on('mouseup touchend', function (e) {
        var container = $('.bootstrap-datetimepicker-widget');
        if (!container.is(e.target) && container.has(e.target).length === 0) {
            container.parent().datetimepicker('hide');
        }
    });
</script>
@endsection