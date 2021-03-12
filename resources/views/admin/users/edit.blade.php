@extends('admin.layouts.app')

@section('title')
    Users
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

                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active"><a href="{{ route('admin.users.index') }}">Users</a></li>
                        <li class="breadcrumb-item active">{{ $user->name }}</li>
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
                <div class="col-md-3">
                    <!-- Profile Image -->
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                <img class="profile-user-img img-fluid img-circle" src="{{ $user->avatar_url }}" alt="User profile picture">
                            </div>

                            <h3 class="profile-username text-center">{{ $user->name }}</h3>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->    
                </div>
                <div class="col-md-8">
                    <div class="card card-info">
                        <!-- form start -->
                        <form class="form-horizontal" method="POST" enctype="multipart/form-data" action="{{ route('admin.users.update', [$user->id]) }}">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                <div class="form-group row">
                                    <label for="input-first_name" class="col-sm-2 col-form-label">First Name</label>
                                    <div class="col-sm-10">
                                        <input name="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror" id="input-first_name" placeholder="First Name" value="{{ $user->first_name }}" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="input-last_name" class="col-sm-2 col-form-label">Last Name</label>
                                    <div class="col-sm-10">
                                        <input name="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror" id="input-last_name" placeholder="Last Name" value="{{ $user->last_name }}" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="input-email" class="col-sm-2 col-form-label">Email</label>
                                    <div class="col-sm-10">
                                        <input name="email" type="email" class="form-control @error('email') is-invalid @enderror" id="input-email" placeholder="Email" value="{{ $user->email }}" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="input-password" class="col-sm-2 col-form-label">Password</label>
                                    <div class="col-sm-10">
                                        <input name="new_password" type="password" class="form-control @error('password') is-invalid @enderror" id="input-password" placeholder="Password">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="input-modilenumber" class="col-sm-2 col-form-label">Mobile Number</label>
                                    <div class="col-sm-10">
                                        <input name="mobile_number" type="text" class="form-control @error('mobile_number') is-invalid @enderror" id="input-modilenumber" placeholder="Mobile Number" value="{{ $user->mobile_number }}" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="input-dob" class="col-sm-2 col-form-label">Date of birth</label>
                                    <div class="col-sm-10">
                                        <input name="birth_date" type="text" class="form-control @error('birth_date') is-invalid @enderror" id="input-dob" placeholder="Date of Birth" value="{{ date('d-m-Y', strtotime($user->birth_date))}}" autocomplete="off" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="input-address1" class="col-sm-2 col-form-label">Street</label>
                                    <div class="col-sm-10">
                                        <input name="address_line_1" type="text" class="form-control @error('address_line_1') is-invalid @enderror" id="input-address1" placeholder="Street Number & Street Name" value="{{ $user->address_line_1 }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="input-address2" class="col-sm-2 col-form-label">Apartment</label>
                                    <div class="col-sm-10">
                                        <input name="address_line_2" type="text" class="form-control @error('address_line_2') is-invalid @enderror" id="input-address2" placeholder="Apartment/Unit Number" value="{{ $user->address_line_2 }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="input-city" class="col-sm-2 col-form-label">City</label>
                                    <div class="col-sm-10">
                                        <input name="city" type="text" class="form-control @error('city') is-invalid @enderror" id="input-city" placeholder="City" value="{{ $user->city }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="input-state" class="col-sm-2 col-form-label">State</label>
                                    <div class="col-sm-10">
                                        <input name="state" type="text" class="form-control @error('state') is-invalid @enderror" id="input-state" placeholder="State/Province" value="{{ $user->state }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="input-country" class="col-sm-2 col-form-label">Country</label>
                                    <div class="col-sm-10">
                                        <input name="country" type="text" class="form-control @error('country') is-invalid @enderror" id="input-country" placeholder="Country" value="{{ $user->country }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="input-postal-code" class="col-sm-2 col-form-label">Postal Code</label>
                                    <div class="col-sm-10">
                                        <input name="postal_code" type="text" class="form-control @error('postal_code') is-invalid @enderror" id="input-postal-code" placeholder="Postal Code" value="{{ $user->postal_code }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="input-referralcode" class="col-sm-2 col-form-label">Referral Code</label>
                                    <div class="col-sm-10">
                                        <input name="referral_code" type="text" class="form-control @error('referral_code') is-invalid @enderror" id="input-referralcode" placeholder="Referral Code" value="{{ $user->referral_code }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="input-consentdocument" class="col-sm-2 col-form-label">Consent Document</label>
                                    <div class="col-sm-10">
                                        <div class="custom-file">
                                            <input type="file" name="consent_document" class="custom-file-input" id="consent_document">
                                            <label class="custom-file-label" for="input-consentdocument">Choose file</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="input-CPRcertificate" class="col-sm-2 col-form-label">CPR Certificate</label>
                                    <div class="col-sm-10">
                                        <div class="custom-file">
                                            <input type="file" name="cpr_certificate" class="custom-file-input" id="cpr_certificate">
                                            <label class="custom-file-label" for="input-CPRcertificate">Choose file</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="input-status" class="col-sm-2 col-form-label">Status</label>
                                    <div class="col-sm-10">
                                        <select class="form-control custom-select" name="status">
                                            <option value="1" @if ($user->status == "1") {{ 'selected' }} @endif>Activate</option>
                                            <option value="0" @if ($user->status == "0") {{ 'selected' }} @endif>Deactivate</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="input-status" class="col-sm-2 col-form-label">Services</label>
                                    <div class="col-sm-10">
                                        @foreach ($services as $key => $service)
                                            @if ( isSubscribedUser( $service->id, $user->id ) && isSubscribedUser( $service->id, $user->id )->status == 'subscribed' )
                                                <div class="custom-control custom-checkbox">
                                                    <input disabled id="service-{{ $service->id }}" checked type="checkbox" class="custom-control-input" value="{{ $service->id }}">
                                                    <label class="custom-control-label" for="service-{{ $service->id }}">{{ $service->name }}</label>
                                                </div>
                                            @else
                                                <div class="custom-control custom-checkbox">
                                                    <input id="service-{{ $service->id }}" data-price="{{$service->price}}" data-title="{{ $service->name }}" name="services[]" type="checkbox" class="custom-control-input service-checkbox" value="{{ $service->id }}">
                                                    <label class="custom-control-label" for="service-{{ $service->id }}">{{ $service->name }}</label> 
                                                </div>   
                                            @endif
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
                                    <div class="offset-sm-2 col-sm-10">
                                        <button type="submit" class="btn btn-success">Update</button>
                                        <a class="btn btn-primary" href="{{ route('admin.users.index') }}">&nbsp;Back&nbsp;</a>
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

        $('.delete-user').on('submit', function(e){
            e.preventDefault();
            if ( confirm("Are you sure want to delete?") ) {
                this.submit();
            }
        });

        var datePickerOptions = {
            autoclose: true,
            orientation: "bottom auto",
            format: 'dd-mm-yyyy',
        };
        $('#input-dob').datepicker(datePickerOptions);
    });
</script>
@endsection