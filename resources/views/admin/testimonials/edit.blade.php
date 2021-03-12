@extends('admin.layouts.app')

@section('title')
    Edit {{ $testimonial->name }}
@endsection

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h4>Edit</h4>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.testimonials.index') }}">Testimonials</a></li>
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
            <div class="row">
                <div class="col-md-8">

                    @include('admin.partials.flash-message')

                    <div class="card card-info">
                        <!-- form start -->
                        <form class="form-horizontal" method="POST" enctype="multipart/form-data" action="{{ route('admin.testimonials.update', [$testimonial->id]) }}">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                <div class="form-group row">
                                    <label for="input-name" class="col-sm-2 col-form-label">Name</label>
                                    <div class="col-sm-10">
                                        <input name="name" type="text" class="form-control @error('name') is-invalid @enderror" id="input-name" placeholder="Name" value="{{ $testimonial->name }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="input-description" class="col-sm-2 col-form-label">Testimony</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control @error('text') is-invalid @enderror" name="text" id="input-text" rows="3">{{ $testimonial->text }}</textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                        <label class="col-sm-2 col-form-label"></label>
                                    <div class="col-sm-10">
                                        <img src="{{ $testimonial->avatar_url }}" class="img-thumbnail" width="100">        
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="image" class="col-sm-2 col-form-label">Image</label>
                                    <div class="col-sm-10">
                                        <div class="custom-file">
                                            <input type="file" name="avatar" class="custom-file-input" id="image">
                                            <label class="custom-file-label" for="image">Choose file</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="offset-sm-2 col-sm-10">
                                        <button type="submit" class="btn btn-success">Update</button>
                                        <a class="btn btn-primary" href="{{ route('admin.testimonials.index') }}">&nbsp;Back&nbsp;</a>
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
<script>
    $(document).ready(function(){
        @if ($message = Session::get('success'))
            toastr.success('{{ $message }}')
        @endif

        @if ($message = Session::get('error'))
            toastr.error('{{ $message }}')
        @endif
    });
</script>
@endsection