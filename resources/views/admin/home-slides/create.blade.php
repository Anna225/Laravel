@extends('admin.layouts.app')

@section('title')
    Add Slide
@endsection

@section('header_scripts')
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{ URL::asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
@endsection

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h4>Add Slide</h4>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.home-slides.index') }}">Homepage Slides</a></li>
                        <li class="breadcrumb-item active">Add Slide</li>
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
                <div class="col-md-10">
                    <div class="card card-info">
                        <!-- form start -->
                        <form class="form-horizontal" method="POST" enctype="multipart/form-data" action="{{ route('admin.home-slides.store') }}">
                            @csrf
                            <div class="card-body">
                                <div class="form-group row">
                                    <label for="input-heading" class="col-sm-2 col-form-label">Heading</label>
                                    <div class="col-sm-10">
                                        <input name="heading" type="text" class="form-control @error('heading') is-invalid @enderror" id="input-heading" placeholder="heading" value="{{ old('heading') }}" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="input-subheading" class="col-sm-2 col-form-label">Subheading</label>
                                    <div class="col-sm-10">
                                        <textarea name="subheading" class="form-control @error('subheading') is-invalid @enderror" id="input-subheading">{{ old('subheading') }}</textarea>
                                    </div>
                                </div>
                                <div class="form-group row ">
                                    <label for="input-cta_label" class="col-sm-2 col-form-label">Button Label</label>
                                    <div class="col-sm-10">
                                        <input name="cta_label" type="text" class="form-control @error('cta_label') is-invalid @enderror" id="input-cta_label" placeholder="Learn More" value="{{ old('cta_label') }}">
                                    </div>
                                </div>
                                {{-- <div class="form-group row ">
                                    <label for="input-cta_link" class="col-sm-2 col-form-label">Button Link</label>
                                    <div class="col-sm-10">
                                        <input name="cta_link" type="text" class="form-control @error('cta_link') is-invalid @enderror" id="input-cta_link" placeholder="https://example.com" value="{{ old('cta_link') }}">
                                    </div>
                                </div>
                                <div class="form-group row ">
                                    <label for="" class="col-sm-2 col-form-label">Target</label>
                                    <div class="col-sm-10">
                                        <div class="icheck-primary">
                                            <input name="cta_target" type="checkbox" id="input-cta_target" value="_blank" />
                                            <label for="input-cta_target"></label>
                                            <small id="emailHelp" class="form-text text-muted">Open button link in new tab</small>
                                        </div>
                                    </div>
                                </div> --}}
                                <div class="form-group row">
                                    <label for="input-image" class="col-sm-2 col-form-label">Image</label>
                                    <div class="col-sm-10">
                                        <div class="custom-file">
                                            <input type="file" name="image" class="custom-file-input" id="input-image" required>
                                            <label class="custom-file-label" for="input-image">Choose file</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-10">
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