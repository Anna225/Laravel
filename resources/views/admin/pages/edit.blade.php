@extends('admin.layouts.app')

@section('title')
    Edit {{ $page->title }}
@endsection

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <a href="{{ route('admin.pages.index') }}">Back</a>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active"><a href="{{ route('admin.pages.index') }}">Pages</a></li>
                        <li class="breadcrumb-item active">Edit {{ $page->title }}</li>
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
                <div class="col-md-12">
                    <div class="card card-info">
                        <!-- form start -->
                        <form class="form-horizontal" method="POST" action="{{ route('admin.pages.update', [$page->id]) }}">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="input-title" class="col-form-label">Title</label>
                                    <input name="title" type="text" class="form-control @error('title') is-invalid @enderror" id="input-title" placeholder="Page Title" value="{{ $page->title }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="input-slug" class="col-form-label">slug</label>
                                    <input name="slug" type="text" class="form-control @error('slug') is-invalid @enderror" id="input-slug" placeholder="Page Slug" value="{{ $page->slug }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="input-content" class="col-form-label">Content</label>
                                    <textarea name="content" type="text" class="form-control" id="input-content" value="{{ old('content') }}" required>{{ html_entity_decode( $page->content ) }}</textarea>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-10">
                                        <button type="submit" class="btn btn-success">Update</button>
                                        <a class="btn btn-primary" href="{{ route('admin.pages.index') }}">&nbsp;Back&nbsp;</a>
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
<script src="{{ asset('vendor/unisharp/laravel-ckeditor/ckeditor.js') }}"></script>
<script>
    CKEDITOR.replace( 'input-content',{
        extraPlugins: 'image2,uploadimage',
        filebrowserUploadUrl: "{{route('admin.image.upload', ['_token' => csrf_token() ])}}",
        filebrowserUploadMethod: 'form',
        height: 500
    } );
</script>
@endsection