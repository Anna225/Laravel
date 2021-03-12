@extends('admin.layouts.app')

@section('title')
    Edit {{ $chapter->name }}
@endsection

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h4></h4>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active"><a href="{{ route('admin.chapters.index') }}">Chapter</a></li>
                        <li class="breadcrumb-item active">{{ $chapter->name }}</li>
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
                        <form class="form-horizontal" method="POST" enctype="multipart/form-data" action="{{ route('admin.chapters.update', [$chapter->id]) }}">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                <div class="form-group row">
                                    <label for="input-name" class="col-sm-2 col-form-label">Name</label>
                                    <div class="col-sm-10">
                                        <input name="name" type="text" class="form-control @error('name') is-invalid @enderror" id="input-name" placeholder="Name" value="{{ $chapter->name }}" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="input-description" class="col-sm-2 col-form-label">Description</label>
                                    <div class="col-sm-10">
                                        <input name="description" type="text" class="form-control @error('description') is-invalid @enderror" id="input-description" placeholder="Desription" value="{{ $chapter->description }}" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label"></label>
                                    <div class="col-sm-10">
                                        <img src="{{ $chapter->image_url }}" class="img-thumbnail" width="100">        
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="image" class="col-sm-2 col-form-label">Image</label>
                                    <div class="col-sm-10">
                                        <div class="custom-file">
                                            <input type="file" name="image" class="custom-file-input" id="image">
                                            <label class="custom-file-label" for="image">Choose file</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="input-questions" class="col-sm-2 col-form-label">Quiz Questions</label>
                                    <div class="col-sm-10">
                                        <input name="quiz_questions" type="number" class="form-control @error('quiz_questions') is-invalid @enderror" id="input-questions" placeholder="No of questions in quiz" value="{{ $chapter->quiz_questions }}" required>
                                        <small class="text-muted">(Can not be more than total number of questions)</small>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="input-min_pass_marks" class="col-sm-2 col-form-label">Min. Passing Marks</label>
                                    <div class="col-sm-10">
                                        <input name="min_pass_marks" type="number" class="form-control @error('min_pass_marks') is-invalid @enderror" id="input-min_pass_marks" placeholder="Min. Passing Marks" value="{{ $chapter->min_pass_marks }}" required>
                                        <small class="text-muted">Number of answers should be correct for passing the quiz. (Can not be more than total number of questions)</small>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="input-time" class="col-sm-2 col-form-label">Study Time (minutes)</label>
                                    <div class="col-sm-10">
                                        <input name="study_time" type="number" class="form-control @error('study_time') is-invalid @enderror" id="input-time" placeholder="Minimum study time" value="{{ $chapter->study_time / 60 }}" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="offset-sm-2 col-sm-10">
                                        <button type="submit" class="btn btn-success">Update</button>
                                        <a class="btn btn-primary" href="{{ route('admin.chapters.index') }}">&nbsp;Back&nbsp;</a>
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