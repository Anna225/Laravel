@extends('admin.layouts.app')

@section('title')
    Home Slide Details
@endsection

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <a href="{{ route('admin.home-slides.index') }}">Back</a>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active"><a href="{{ route('admin.home-slides.index') }}">Services</a></li>
                        <li class="breadcrumb-item active">{{ $home_slide->name }}</li>
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
                    <a class="btn btn-primary pull-right" href="{{ route('admin.home-slides.edit',$home_slide->id) }}">
                        Edit Service
                    </a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-10">
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <td>Heading </td>
                                <td>
                                    {{ $home_slide->heading }}
                                </td>
                            </tr>
                            <tr>
                                <td>Description </td>
                                <td>
                                    {{ $home_slide->subheading }}
                                </td>
                            </tr>
                            <tr>
                                <td>Button Label</td>
                                <td>
                                    {{ $home_slide->cta_label }}
                                </td>
                            </tr>
                            {{-- <tr>
                                <td>Button Link</td>
                                <td>
                                    <a target="{{ $home_slide->cta_target }}" href="{{ $home_slide->cta_link }}">{{ $home_slide->cta_link }}</a>
                                </td>
                            </tr> --}}
                            <tr>
                                <td>Image </td>
                                <td>
                                    <img width="300" src="{{ $home_slide->image_url }}" >
                                </td>
                            </tr>
                            
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
@endsection