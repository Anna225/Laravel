@extends('admin.layouts.app')

@section('title')
    Add Tutorial
@endsection

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h4>Add Question</h4>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.tutorials.index') }}">Tutorials</a></li>
                        <li class="breadcrumb-item active">Add Tutorial</li>
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
                    @if ( empty($chapters) )
                        <div class="alert alert-warning alert-block">
                            <button type="button" class="close" data-dismiss="alert">×</button>	
                            <strong>No chapters found. Please add more chapters from <a style="color:black;" href="{{ route('admin.chapters.create') }}">Here</a></strong>
                        </div>        
                    @endif                   

                    @include('admin.partials.flash-message')

                    <div class="card card-info">
                        <!-- form start -->
                        <form class="form-horizontal" method="POST" action="{{ route('admin.tutorials.store') }}">
                            @csrf
                            <div class="card-body">
                                <div class="form-group row">
                                    <label for="input-name" class="col-sm-2 col-form-label">Tutorial Name</label>
                                    <div class="col-sm-10">
                                        <input name="name" type="text" class="form-control @error('name') is-invalid @enderror" id="input-name" placeholder="Name" value="{{ old('name') }}" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="chapter" class="col-sm-2 col-form-label">Training Chapter</label>
                                    <div class="col-sm-10">
                                        <select id="chapter" name="training_chapter_id" class="form-control" required>
                                            <option value="">--- Select Chapter ---</option>

                                            @foreach ($chapters as $chapter)
                                                <option value="{{ $chapter['id'] }}">{{ $chapter['name'] }}</option>
                                            @endforeach
                                        </select>
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