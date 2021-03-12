@extends('admin.layouts.app')

@section('title')
    {{ $chapter->name }}
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
                        <li class="breadcrumb-item active"><a href="{{ route('admin.chapters.index') }}">Chapters</a></li>
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
            <div style="margin-bottom: 10px;" class="row">
                <div class="col-lg-12">
                    <a class="btn btn-primary pull-right" href="{{ route('admin.chapters.edit',$chapter->id) }}">
                        Edit Chapter
                    </a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-7">
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <td>Name </td>
                                <td>
                                    {{ $chapter->name }}
                                </td>
                            </tr>
                            <tr>
                                <td>Description </td>
                                <td>
                                    {{ $chapter->description }}
                                </td>
                            </tr>
                            <tr>
                                <td>Total Quiz Questions </td>
                                <td>
                                    {{ $chapter->quiz_questions }}
                                </td>
                            </tr>
                            <tr>
                                <td>Study Time </td>
                                <td>
                                    {{ $chapter->study_time / 60 }} minutes
                                </td>
                            </tr>
                            <tr>
                                <td>Image </td>
                                <td>
                                    <img width="300" src="{{ $chapter->image_url }}">
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