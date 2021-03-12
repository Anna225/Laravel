@extends('admin.layouts.app')

@section('title')
    Add User
@endsection

@section('header_scripts')
    <link rel="stylesheet" href="{{ asset('plugins/bootstrap-datepicker/bootstrap-datepicker3.min.css') }}">
@endsection

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h4>Add User</h4>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.users.index') }}">Users</a></li>
                        <li class="breadcrumb-item active">Add User</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
                @include('admin.partials.flash-message')
            <div class="row">
                <div class="col-md-8">
                    <div class="card card-info">
                        <!-- form start -->
                        <form class="form-horizontal" method="POST" enctype="multipart/form-data" action="{{ route('admin.users.store') }}">
                            @csrf
                            <div class="card-body">
                                <div class="form-group row">
                                    <label for="input-first_name" class="col-sm-2 col-form-label">First Name</label>
                                    <div class="col-sm-10">
                                        <input name="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror" id="input-first_name" placeholder="First Name" value="{{ old('first_name') }}" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="input-last_name" class="col-sm-2 col-form-label">Last Name</label>
                                    <div class="col-sm-10">
                                        <input name="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror" id="input-last_name" placeholder="Last Name" value="{{ old('last_name') }}" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="input-email" class="col-sm-2 col-form-label">Email</label>
                                    <div class="col-sm-10">
                                        <input name="email" type="email" class="form-control @error('email') is-invalid @enderror" id="input-email" placeholder="Email" value="{{ old('email') }}" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="input-password" class="col-sm-2 col-form-label">Password</label>
                                    <div class="col-sm-10">
                                        <input name="password" type="password" class="form-control @error('password') is-invalid @enderror" id="input-password" placeholder="Password" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="input-modilenumber" class="col-sm-2 col-form-label">Mobile Number</label>
                                    <div class="col-sm-10">
                                        <input name="mobile_number" type="number" class="form-control @error('mobile_number') is-invalid @enderror" id="input-modilenumber" placeholder="Mobile Number" value="{{ old('mobile_number') }}" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="input-dob" class="col-sm-2 col-form-label">Date of birth</label>
                                    <div class="col-sm-10">
                                        <input name="birth_date" type="text" class="form-control @error('birth_date') is-invalid @enderror" id="input-dob" placeholder="Date of Birth" autocomplete="off" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="input-address1" class="col-sm-2 col-form-label">Street</label>
                                    <div class="col-sm-10">
                                        <input name="address_line_1" type="text" class="form-control @error('address_line_1') is-invalid @enderror" id="input-address1" placeholder="Street Number & Street Name" value="{{ old('address_line_1') }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="input-address2" class="col-sm-2 col-form-label">Apartment</label>
                                    <div class="col-sm-10">
                                        <input name="address_line_2" type="text" class="form-control @error('address_line_2') is-invalid @enderror" id="input-address2" placeholder="Apartment/Unit Number" value="{{ old('address_line_2') }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="input-city" class="col-sm-2 col-form-label">City</label>
                                    <div class="col-sm-10">
                                        <input name="city" type="text" class="form-control @error('city') is-invalid @enderror" id="input-city" placeholder="City" value="{{ old('city') }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="input-state" class="col-sm-2 col-form-label">State</label>
                                    <div class="col-sm-10">
                                        <input name="state" type="text" class="form-control @error('state') is-invalid @enderror" id="input-state" placeholder="State/Province" value="{{ old('state') }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="input-country" class="col-sm-2 col-form-label">Country</label>
                                    <div class="col-sm-10">
                                        <input name="country" type="text" class="form-control @error('country') is-invalid @enderror" id="input-country" placeholder="Country" value="{{ old('country') }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="input-postal-code" class="col-sm-2 col-form-label">Postal Code</label>
                                    <div class="col-sm-10">
                                        <input name="postal_code" type="text" class="form-control @error('postal_code') is-invalid @enderror" id="input-postal-code" placeholder="Postal Code" value="{{ old('postal_code') }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="input-referralcode" class="col-sm-2 col-form-label">Referral Code</label>
                                    <div class="col-sm-10">
                                        <input name="referral_code" type="text" class="form-control @error('referral_code') is-invalid @enderror" id="input-referralcode" placeholder="Referral Code" value="{{ old('referral_code') }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="input-status" class="col-sm-2 col-form-label">Status</label>
                                    <div class="col-sm-10">
                                        <select class="form-control custom-select" name="status">
                                            <option value="1" @if (old('status') == "1") {{ 'selected' }} @endif>Active</option>
                                            <option value="0" @if (old('status') == "0") {{ 'selected' }} @endif>Deactive</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="input-status" class="col-sm-2 col-form-label">Services</label>
                                    <div class="col-sm-10">
                                        @foreach ($services as $key => $service)
                                            <div class="custom-control custom-checkbox">
                                                <input class="custom-control-input" type="checkbox" name="services[]" id="customCheckbox-{{ $key }}" value="{{ $service->id }}">
                                                <label for="customCheckbox-{{ $key }}" class="custom-control-label">{{ $service->name }}</label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                {{-- <div class="form-group row">
                                    <label for="avatar" class="col-sm-2 col-form-label">Avatar</label>
                                    <div class="col-sm-10">
                                        <div class="custom-file">
                                            <input type="file" name="avatar" class="custom-file-input" id="avatar">
                                            <label class="custom-file-label" for="avatar">Choose file</label>
                                        </div>
                                    </div>
                                </div> --}}
                                <div class="form-group row">
                                    <div class="col-sm-10">
                                        <input type="submit" name="submit" class="btn btn-info" value="Save" />
                                        <input type="submit" name="submit" value="Save and Add another" class="btn btn-info">
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
{{-- <script src="{{ URL::asset('plugins/inputmask/min/jquery.inputmask.bundle.min.js') }}"></script> --}}
<script>
    $(document).ready(function(){
        @if ($message = Session::get('success'))
            toastr.success('{{ $message }}')
        @endif

        @if ($message = Session::get('error'))
            toastr.error('{{ $message }}')
        @endif

        //$('[data-mask]').inputmask();

        var datePickerOptions = {
            autoclose: true,
            orientation: "bottom auto",
            format: 'dd-mm-yyyy',
        };
        $('#input-dob').datepicker(datePickerOptions);
    });
</script>
@endsection