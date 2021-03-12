@extends('admin.layouts.app')

@section('title')
    Transaction Details
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
                        <li class="breadcrumb-item active"><a href="{{ route('admin.failed.transactions') }}">Failed Transactions</a></li>
                        <li class="breadcrumb-item active">{{ $transaction->name }}</li>
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

                </div>
            </div>
            <div class="row">
                <div class="col-md-7">
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <td>Email </td>
                                <td>
                                    {{ $transaction->email }}
                                </td>
                            </tr>
                            <tr>
                                <td>Name </td>
                                <td>
                                    {{ $transaction->name }}
                                </td>
                            </tr>
                            <tr>
                                <td>Page </td>
                                <td>
                                    {{ $transaction->page }}
                                </td>
                            </tr>
                            <tr>
                                <td>Payment Response </td>
                                <td>
                                    {{ $transaction->payment_response }}
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