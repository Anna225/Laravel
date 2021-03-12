@extends('admin.layouts.app')

@section('title')
    Edit Tutorial
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
                    <a href="{{ route('admin.tutorials.index',$tutorial->training_chapter_id) }}">Back</a>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.tutorials.index') }}">Tutorials</a></li>
                        <li class="breadcrumb-item active">Edit Tutorial</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-10">

                    @include('admin.partials.flash-message')

                    <div class="card card-info">
                        <!-- form start -->
                        <form class="form-horizontal" method="POST" action="{{ route('admin.tutorials.update', $tutorial->id) }}">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                <div class="form-group row">
                                    <label for="input-name" class="col-sm-2 col-form-label">Tutorial</label>
                                    <div class="col-sm-10">
                                        <input name="name" type="text" class="form-control @error('name') is-invalid @enderror" id="input-name" placeholder="Tutorial" value="{{ $tutorial->name }}" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="offset-sm-2 col-sm-10">
                                        {{-- <input type="hidden" name="training_chapter_id" value="{{ $tutorial->training_chapter_id }}"> --}}
                                        <button type="submit" class="btn btn-success">Update</button>
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
