@extends('layouts.app')

@section('header_scripts')
    <link rel="stylesheet" href="{{ asset('plugins/bootstrap-datepicker/bootstrap-datepicker3.min.css') }}">
@endsection

@section('content')
<div class="insite-content">

    <div class="my-courses">
        <div class="container pt-4">
            <div class="sec-title">
                <h1>My courses</h1>
            </div>
            <div class="table-responsive mt-4">
                <table class="table">
                    <tbody>
                        @forelse ($mySubscriptions as $subscriptions)
                            <tr>
                                <td>{{ $subscriptions->service->name }} &nbsp; &nbsp; <span class="badge badge-success">Active</span></td>
                            </tr>
                        @empty
                            <div class="alert alert-warning" role="alert">
                                You have no active service subscription right now.
                            </div>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="my-consent-form">
        <div class="container pt-4">
            <div class="row mt-4">
                <div class="col-md-6 col-lg-6">
                    <div class="sec-title">
                        <h1>My Consent Form</h1>
                    </div>
                    @isset($user->consent_document)
                    <div class="p-3 mb-2 bg-light text-dark mt-3">
                        <a download href="{{ route('get.document', $user->consent_document->document ) }}">My Consent Document</a> &nbsp; &nbsp; &nbsp; 
                        @if ( $user->consent_document->status == 'approved' )
                            <span class="badge badge-success">Approved</span>
                        @elseif( $user->consent_document->status == 'pending' )
                            <span class="badge badge-secondary">Pending</span>
                        @else
                            <span class="badge badge-danger">Not Approved</span>
                        @endif
                    </div>
                    @endisset            
                    <form action="{{ route('consent-document.upload') }}" method="POST" enctype="multipart/form-data">
                        <div class="row">
                            <div class="form-group col-md-6">
                                <div class="custom-file mt-3 input-group">
                                    <input type="file" name="consent_document" class="custom-file-input" id="logo">
                                    <label class="custom-file-label" for="image">Choose file</label>
                                </div>
                                @error('consent_document')
                                    <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group col-md-6 mt-2">
                                @csrf
                                <button class="btn btn-primary mb-3" type="submit">Upload</button>
                            </div>
                        </div>
                        
                    </form>
                </div>
                <div class="col-lg-1"></div>
                <div class="col-md-6 col-lg-5">
                    <div class="sec-title">
                        <h1>CPR Certificate</h1>
                    </div>
                    @isset($user->cpr_certificate)
                    <div class="p-3 mb-2 bg-light text-dark mt-3">
                        <a download href="{{ route('get.cpr_certificate', $user->cpr_certificate->document ) }}">My CPR Certificate</a> &nbsp; &nbsp; &nbsp;
                        <a download class="" href="" title="Remove"><i class="fas fa-fw fa-remove"></i></a>
                    </div>
                    @endisset
                    <form action="{{ route('cpr-certificate.upload') }}" method="POST" enctype="multipart/form-data">
                        <div class="row">
                            <div class="form-group col-md-6">
                                <div class="custom-file mt-3 input-group">
                                    <input type="file" name="cpr_certificate" class="custom-file-input" id="logo">
                                    <label class="custom-file-label" for="image">Choose file</label>
                                </div>
                                @error('cpr_certificate')
                                    <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group col-md-6 mt-2">
                                @csrf
                                <button class="btn btn-primary mb-3" type="submit">Upload</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="site-part">
        <div class="container pb-5">
            {{-- @include('partials.flash-message') --}}
            <div class="row mt-4">
                <div class="col-md-6 col-lg-6">
                    <form action="{{ route('myaccount.action') }}" method="post">
                        @csrf
                        <div class="sec-title mb-4">
                            <h1>My Account</h1>
                        </div>
                        <div class="row">
                            <div class="form-group col-12 col-sm-6">
                                <label>First Name</label>
                                <input type="text" name="first_name" class="form-control @error('first_name') is-invalid @enderror" placeholder="First Name" value="{{ $user->first_name }}" required>
                                @error('first_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group col-12 col-sm-6">
                                <label>Last Name</label>
                                <input type="text" name="last_name" class="form-control @error('last_name') is-invalid @enderror" placeholder="Last Name" value="{{ $user->last_name }}" required>
                                @error('last_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group col-12">
                                <label>Email Address</label>
                                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email Address" value="{{ $user->email }}" required>
                                
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group col-12">
                                <label>Phone Number</label>
                            <input type="tel" name="mobile_number" class="form-control @error('mobile_number') is-invalid @enderror" placeholder="Phone Number" value="{{ $user->mobile_number }}" required>

                                @error('mobile_number')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group col-12">
                                <label>Date of Birth</label>
                                <input type="text" name="birth_date" id="birth_date" class="form-control @error('birth_date') is-invalid @enderror" placeholder="DD/MM/YYYY" value="{{ date("d-m-Y", strtotime($user->birth_date)) }}" required>

                                @error('birth_date')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group col-12">
                                <label>Street Number & Street Name</label>
                                <input type="text" name="addres_line_1" class="form-control @error('address_line_1') is-invalid @enderror" placeholder="Street Number & Street Name" value="{{ $user->address_line_1 }}">

                                @error('address_line_1')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group col-12">
                                <label>Apartment/Unit Number</label>
                                <input type="text" name="address_line_2" class="form-control @error('address_line_2') is-invalid @enderror" placeholder="Apartment/Unit Number" value="{{ $user->address_line_2 }}">
                            
                                @error('address_line_2')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group col-12 col-sm-6">
                                <label>City</label>
                                <input type="text" name="city" class="form-control @error('city') is-invalid @enderror" placeholder="City" value="{{ $user->city }}" required>
                                
                                @error('city')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror    
                            </div>

                            <div class="form-group col-12 col-sm-6">
                                <label>Province/State</label>
                                <input type="text" name="state" class="form-control @error('state') is-invalid @enderror" placeholder="Province/State" value="{{ $user->state }}" required>
                            
                                @error('state')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror    
                            </div>

                            <div class="form-group col-12 col-sm-6">
                                <label>Postal Code</label>
                                <input type="text" name="postal_code" class="form-control @error('postal_code') is-invalid @enderror" placeholder="Postal Code" value="{{ $user->postal_code }}" required>
                            
                                @error('postal_code')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror    
                            </div>

                            <div class="form-group col-12 col-sm-6">
                                <label>Country</label>
                                <input type="text" name="country" class="form-control @error('country') is-invalid @enderror" placeholder="Country" value="{{ $user->country }}" required>
                            
                                @error('country')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="mt-30">
                            <button class="btn btn-primary mb-3" type="submit">Update</button>
                        </div>
                    </form>
                </div>
                <div class="col-lg-1"></div>
                <div class="col-md-6 col-lg-5">
                    <div class="sec-title mb-4">
                        <h1>Change Password</h1>
                    </div>
                    <form action="{{ route('change-password') }}" method="post" id="password-form">
                        @csrf
                        <div class="row">
                            <div class="form-group col-12">
                                <label>Current Password</label>
                                <input type="password"  name="current_password" id="current-password" class="form-control @error('current_password') is-invalid @enderror" placeholder="Enter Current Password">

                                @error('current_password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group col-12">
                                <label>New Password</label>
                                <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" placeholder="Enter New Password">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group col-12">
                                <label>Confirm New Password</label>
                                <input type="password" name="password_confirmation" class="form-control" id="password-confirm" placeholder="Enter Confirm New Password">
                            </div>
                        </div>
                        <div class="mt-30">
                            <button class="btn btn-primary mb-3" type="submit">Change Password</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection

@section('footer_scripts')
<script src="{{ URL::asset('plugins/moment/moment.min.js') }}"></script>
<script src="{{ URL::asset('plugins/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
<script>
    $(document).ready(function(){
        @if ($message = Session::get('success'))
            toastr.success('{{ $message }}')
        @endif

        @if ($message = Session::get('error'))
            toastr.error('{{ $message }}')
        @endif

        $('#birth_date').datepicker({});

    });
</script>
@endsection