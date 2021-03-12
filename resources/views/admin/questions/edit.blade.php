@extends('admin.layouts.app')

@section('title')
    Edit Question
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
                    <a href="{{ route('admin.questions',$question->training_chapter_id) }}">Back</a>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.questions',$question->training_chapter_id) }}">Questions</a></li>
                        <li class="breadcrumb-item active">Edit Question</li>
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
                        <form class="form-horizontal" method="POST" action="{{ route('admin.questions.update', $question->id) }}">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                <div class="form-group row">
                                    <label for="input-question" class="col-sm-2 col-form-label">Question</label>
                                    <div class="col-sm-10">
                                        <input name="question" type="text" class="form-control @error('question') is-invalid @enderror" id="input-question" placeholder="Question" value="{{ $question->question }}" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="offset-sm-2 col-sm-10">
                                        <input type="hidden" name="training_chapter_id" value="{{ $question->training_chapter_id }}">
                                        <button type="submit" class="btn btn-success">Update</button>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </form>
                    </div>
                    <!-- /.card card-info- -->
                    <div class="card">
                        <form action="{{ route('admin.options.update', $question->id) }}" method="POST" class="form-horizontal option-form">
                            @csrf
                            @method('PUT')
                            <div class="card-header">
                                <h3 class="card-title">
                                        <i class="fas fa-list-alt"></i>
                                    Options
                                </h3>
                            </div>
                            <div class="card-body">
                                <div class="form-group row single-option">
                                    <label for="input-option1" class="col-form-label">A</label>
                                    <div class="col-sm-10">
                                        <input name="options[]" type="text" class="form-control @error('option') is-invalid @enderror" id="input-option1" placeholder="Option" value="{{ $question->options[0]->option ?? '' }}" required>
                                    </div>
                                    <div class="icheck-primary d-inline">
                                        <input type="radio" name="is_correct" id="answer-0" value="0" required
                                        @if ( isset($question->options[0]) && $question->options[0]->is_correct )
                                            checked
                                        @endif
                                        >
                                        <label for="answer-0"></label>
                                    </div>
                                </div>
                                <div class="form-group row single-option">
                                    <label for="input-option2" class="col-sm-0 col-form-label">B</label>
                                    <div class="col-sm-10">
                                        <input name="options[]" type="text" class="form-control @error('option') is-invalid @enderror" id="input-option2" placeholder="Option" value="{{ $question->options[1]->option ?? '' }}" required>
                                    </div>
                                    <div class="icheck-primary d-inline">
                                        <input type="radio" name="is_correct" id="answer-1" value="1" required
                                        @if ( isset($question->options[1]) && $question->options[1]->is_correct )
                                            checked
                                        @endif 
                                        >
                                        <label for="answer-1"></label>
                                    </div>
                                </div>
                                <div class="form-group row single-option">
                                    <label for="input-option3" class="col-sm-0 col-form-label">C</label>
                                    <div class="col-sm-10">
                                        <input name="options[]" type="text" class="form-control @error('option') is-invalid @enderror" id="input-option3" placeholder="Option" value="{{ $question->options[2]->option ?? '' }}" required>
                                    </div>
                                    <div class="icheck-primary d-inline">
                                        <input type="radio" name="is_correct" id="answer-2" value="2" required 
                                        @if ( isset($question->options[2]) && $question->options[2]->is_correct )
                                            checked
                                        @endif
                                        >
                                        <label for="answer-2"></label>
                                    </div>
                                </div>
                                <div class="form-group row single-option">
                                    <label for="input-option4" class="col-sm-0 col-form-label">D</label>
                                    <div class="col-sm-10">
                                        <input name="options[]" type="text" class="form-control @error('option') is-invalid @enderror" id="input-option4" placeholder="Option" value="{{ $question->options[3]->option ?? '' }}" required>
                                    </div>
                                    <div class="icheck-primary d-inline">
                                        <input type="radio" name="is_correct" id="answer-3" value="3" required 
                                        @if ( isset($question->options[3]) && $question->options[3]->is_correct )
                                            checked
                                        @endif
                                        >
                                        <label for="answer-3"></label>
                                    </div>
                                </div>
                                <div class="form-group row add-more-wrap">
                                    <div class="col-sm-10">
                                        <input type="hidden" name="training_chapter_id" value="{{ $question->training_chapter_id }}">
                                        <input type="hidden" name="question_id" value="{{ $question->id }}">
                                        <button class="btn btn-success" id="add-more">Update</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- /.card card-info- -->
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