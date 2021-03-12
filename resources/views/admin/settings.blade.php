@extends('admin.layouts.app')

@section('title')
    Settings
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
                        <li class="breadcrumb-item active">Settings</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            @if ($errors->any())
                <div class="row">
                    <div class="alert alert-danger col-md-12">
                        <button type="button" class="close" data-dismiss="alert">×</button>	
                        <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{$error}}</li>
                        @endforeach
                        </ul>
                    </div>
                </div>
            @endif
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h4>Settings</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-5 col-sm-3">
                            <div class="nav flex-column nav-tabs h-100" id="vert-tabs-tab" role="tablist"
                                aria-orientation="vertical">
                                <a class="nav-link active" id="vert-tabs-general-tab" data-toggle="pill" href="#vert-tabs-general" role="tab" aria-controls="vert-tabs-general" aria-selected="true">General</a>
                                <a class="nav-link" id="vert-tabs-social-tab" data-toggle="pill" href="#vert-tabs-social" role="tab" aria-controls="vert-tabs-social" aria-selected="false">Social</a>
                                <a class="nav-link" id="vert-tabs-address-tab" data-toggle="pill" href="#vert-tabs-address" role="tab" aria-controls="vert-tabs-address" aria-selected="false">Address & Contact</a>
                                <a class="nav-link" id="vert-tabs-referral-tab" data-toggle="pill" href="#vert-tabs-referral" role="tab" aria-controls="vert-tabs-referral" aria-selected="false">Referral Block</a>
                            </div>
                        </div>
                        <div class="col-7 col-sm-9">
                            <div class="tab-content" id="vert-tabs-tabContent">
                                <div class="tab-pane text-left fade active show" id="vert-tabs-general" role="tabpanel" aria-labelledby="vert-tabs-general-tab">
                                    <form class="form-horizontal" method="POST" enctype="multipart/form-data" action="{{ route('admin.settings') }}">
                                        @csrf
                                        <div class="card-body">
                                            <div class="form-group row">
                                                <label for="logo" class="col-sm-3 col-form-label">Logo</label>
                                                <div class="col-sm-9">
                                                    <div class="custom-file">
                                                        <input type="file" name="site_logo" class="" id="logo">
                                                    </div>
                                                    <img src="{{ asset($options->site_logo ?? '')}}" class="img-thumbnail" width="100">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="site_favicon" class="col-sm-3 col-form-label">Favicon</label>
                                                <div class="col-sm-9">
                                                    <div class="custom-file">
                                                        <input type="file" name="site_favicon" class="" id="site_favicon">
                                                    </div>
                                                    <img src="{{ asset($options->site_favicon ?? '')}}" class="img-thumbnail" width="60">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="consent_form" class="col-sm-3 col-form-label">Consent Form</label>
                                                <div class="col-sm-9">
                                                    <div class="custom-file">
                                                        <input type="file" name="consent_form" class="" id="consent_form">
                                                    </div>
                                                    <a href="{{ asset($options->consent_form ?? '')}}">Current Form</a>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="final_questions" class="col-sm-3 col-form-label">Questions for final quiz</label>
                                                <div class="col-sm-9">
                                                    <input type="number" name="total_final_questions" class="form-control" id="final_questions" value="{{ $options->total_final_questions ?? '' }}">
                                                    <small class="text-muted">Total questions for final quiz. (can not be more than {{ $totalQuestions }})</small>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="final_questions" class="col-sm-3 col-form-label">Min. Passing Marks</label>
                                                <div class="col-sm-9">
                                                    <input type="number" name="final_pass_marks" class="form-control" id="final_questions" value="{{ $options->final_pass_marks ?? '' }}">
                                                    <small class="text-muted">Minimum marks to pass final quiz. (Can not be more than {{ $totalQuestions }})</small>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="google_tag_id" class="col-sm-3 col-form-label">Google Tag Id</label>
                                                <div class="col-sm-9">
                                                    <input type="text" name="google_tag_id" class="form-control" id="google_tag_id" value="{{ $options->google_tag_id ?? '' }}">
                                                    <small class="text-muted">Google Analytic Id</small>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="offset-sm-3 col-sm-9">
                                                    <button type="submit" class="btn btn-success">Save </button>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /.card-body -->
                                    </form>
                                </div>
                                <div class="tab-pane fade" id="vert-tabs-social" role="tabpanel" aria-labelledby="vert-tabs-social-tab">
                                    <!-- form start -->
                                    <form class="form-horizontal" method="POST" enctype="multipart/form-data" action="{{ route('admin.settings') }}">
                                        @csrf
                                        <div class="card-body">
                                            <div class="form-group row">
                                                <label for="facebook_link" class="col-sm-3 col-form-label">Faceook</label>
                                                <div class="col-sm-9">
                                                    <input type="url" name="facebook_link" class="form-control" id="facebook_link" value="{{ $options->facebook_link ?? '' }}">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="twitter_link" class="col-sm-3 col-form-label">Twitter</label>
                                                <div class="col-sm-9">
                                                    <input type="url" name="twitter_link" class="form-control" id="twitter_link" value="{{ $options->twitter_link ?? '' }}">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="instagram_link" class="col-sm-3 col-form-label">Instagram</label>
                                                <div class="col-sm-9">
                                                    <input type="url" name="instagram_link" class="form-control" id="instagram_link" value="{{ $options->instagram_link ?? '' }}">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="linkedin_link" class="col-sm-3 col-form-label">Linkedin</label>
                                                <div class="col-sm-9">
                                                    <input type="url" name="linkedin_link" class="form-control" id="linkedin_link" value="{{ $options->linkedin_link ?? '' }}">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="offset-sm-3 col-sm-9">
                                                    <button type="submit" class="btn btn-success">Save </button>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /.card-body -->
                                    </form>
                                </div>
                                <div class="tab-pane fade" id="vert-tabs-address" role="tabpanel" aria-labelledby="vert-tabs-address-tab">
                                    <!-- form start -->
                                    <form class="form-horizontal" method="POST" enctype="multipart/form-data" action="{{ route('admin.settings') }}">
                                        @csrf
                                        <div class="card-body">
                                            <div class="form-group row">
                                                <label for="public_address" class="col-sm-3 col-form-label">Address</label>
                                                <div class="col-sm-9">
                                                    <input type="text" name="public_address" class="form-control" id="public_address" value="{{ $options->public_address ?? '' }}">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="public_phone" class="col-sm-3 col-form-label">Phone</label>
                                                <div class="col-sm-9">
                                                    <input type="text" name="public_phone" class="form-control" id="public_phone" value="{{ $options->public_phone ?? '' }}">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="public_email" class="col-sm-3 col-form-label">Public Email</label>
                                                <div class="col-sm-9">
                                                    <input required type="text" name="public_email" class="form-control" id="public_email" value="{{ $options->public_email ?? '' }}">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="admin_email" class="col-sm-3 col-form-label">Admin Address</label>
                                                <div class="col-sm-9">
                                                    <input required type="text" name="admin_email" class="form-control" id="admin_email" value="{{ $options->admin_email ?? '' }}">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="offset-sm-3 col-sm-9">
                                                    <button type="submit" class="btn btn-success">Save </button>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /.card-body -->
                                    </form>
                                </div>
                                <div class="tab-pane fade" id="vert-tabs-referral" role="tabpanel" aria-labelledby="vert-tabs-referral-tab">
                                    <!-- form start -->
                                    <form class="form-horizontal" method="POST" enctype="multipart/form-data" action="{{ route('admin.settings') }}">
                                        @csrf
                                        <div class="card-body">
                                            <div class="form-group row">
                                                <label for="referral_heading" class="col-sm-3 col-form-label">Heading</label>
                                                <div class="col-sm-9">
                                                    <input type="text" name="referral_heading" class="form-control" id="referral_heading" value="{{ $options->referral_heading ?? '' }}">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="referral_subheading" class="col-sm-3 col-form-label">Sub Heading</label>
                                                <div class="col-sm-9">
                                                    <textarea name="referral_subheading" class="form-control" id="referral_subheading"> {{ $options->referral_subheading ?? '' }}</textarea>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="offset-sm-3 col-sm-9">
                                                    <button type="submit" class="btn btn-success">Save </button>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /.card-body -->
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
@endsection
@section('footer_scripts')
<script>
    $(document).ready(function(){
        @if ($message = Session::get('success'))
            toastr.success('{{ $message }}')
        @endif

        @if ($message = Session::get('error'))
            toastr.error('{{ $message }}')
        @endif

        if (location.hash) {
            $("a[href='" + location.hash + "']").tab("show");
        }
        $(document.body).on("click", "a[data-toggle='tab']", function(event) {
            location.hash = this.getAttribute("href");
        });
    });
    $(window).on("popstate", function() {
        var anchor = location.hash || $("a[data-toggle='tab']").first().attr("href");
        $("a[href='" + anchor + "']").tab("show");
    });
</script>
@endsection