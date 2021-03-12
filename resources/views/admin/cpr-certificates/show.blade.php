@extends('admin.layouts.app')

@section('title')

@endsection

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <a href="{{ route('admin.cpr-certificates.index') }}">Back</a>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.cpr-certificates.index') }}">CPR Certificate</a></li>
                        <li class="breadcrumb-item active">{{ $document->user->name }}</li>
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
                    <table class="table table-bordered table-hover">
                        <tbody>
                            <tr>
                                <td>User Name </td>
                                <td>
                                    {{ $document->user->name }}
                                </td>
                            </tr>
                            <tr>
                                <td>Document </td>
                                <td>
                                    <a href="{{ route("get.cpr_certificate", $document->document ) }}" target="_blank">{{ $document->document }}</a>
                                </td>
                            </tr>
                            <tr>
                                <td>Uploaded Date </td>
                                <td>
                                    {{ $document->uploaded_date }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

@endsection