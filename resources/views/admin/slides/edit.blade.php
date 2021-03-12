@extends('admin.layouts.app')

@section('title')
    Edit {{ $slide->title }}
@endsection

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <a href="{{ route('admin.slides.index', $slide->training_chapter_id) }}">Back</a>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active"><a href="{{ route('admin.slides.index', $slide->training_chapter_id) }}">Slides</a></li>
                        <li class="breadcrumb-item active">Edit {{ $slide->title }}</li>
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
                        <form class="form-horizontal" method="POST" action="{{ route('admin.slides.update', [$slide->id]) }}">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="input-title" class="col-form-label">Title</label>
                                    <input name="title" type="text" class="form-control @error('title') is-invalid @enderror" id="input-title" placeholder="Slide Title" value="{{ $slide->title }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="input-content" class="col-form-label">Content</label>
                                    <textarea name="content" type="text" class="form-control" id="input-content" value="{{ old('content') }}" required>{{ html_entity_decode( $slide->content ) }}</textarea>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-10">
                                        <button type="submit" class="btn btn-success">Update</button>
                                        <input type="hidden" name="chapter_id" value={{ $slide->training_chapter_id }} />
                                        <a class="btn btn-primary" href="{{ route('admin.slides.index',$slide->training_chapter_id) }}">&nbsp;Back&nbsp;</a>
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
    $(document).ready(function(){
        @if ($message = Session::get('success'))
            toastr.success('{{ $message }}')
        @endif

        @if ($message = Session::get('error'))
            toastr.error('{{ $message }}')
        @endif
    });

    CKEDITOR.replace( 'input-content',{
        extraPlugins: 'image2,uploadimage',
        filebrowserUploadUrl: "{{route('admin.image.upload', ['_token' => csrf_token() ])}}",
        filebrowserUploadMethod: 'form',
        height: 500,
        allowedContent:true
    } );
</script>
@endsection