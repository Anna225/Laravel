@extends('admin.layouts.app')

@section('title')
    {{ $testimonial->name }}
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
                        <li class="breadcrumb-item active"><a href="{{ route('admin.testimonials.index') }}">Testimonials</a></li>
                        <li class="breadcrumb-item active">{{ $testimonial->name }}</li>
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
                    <a class="btn btn-primary pull-right" href="{{ route('admin.testimonials.edit',$testimonial->id) }}">
                        <i class="fas fa-edit"></i> Edit
                    </a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-10">
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <td>Name </td>
                                <td>
                                    {{ $testimonial->name }}
                                </td>
                            </tr>
                            <tr>
                                <td>Testimony </td>
                                <td>
                                    {{ $testimonial->text ?? '' }}
                                </td>
                            </tr>
                            <tr>
                                <td>Image </td>
                                <td>
                                    <img width="250" src="{{ $testimonial->avatar_url }}" >
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