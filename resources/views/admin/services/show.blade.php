@extends('admin.layouts.app')

@section('title')
    {{ $service->name }}
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
                        <li class="breadcrumb-item active"><a href="{{ route('admin.services.index') }}">Services</a></li>
                        <li class="breadcrumb-item active">{{ $service->name }}</li>
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
                    <a class="btn btn-primary pull-right" href="{{ route('admin.services.edit',$service->id) }}">
                        Edit Service
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
                                    {{ $service->name }}
                                </td>
                            </tr>
                            <tr>
                                <td>Description </td>
                                <td>
                                    {{ $service->description }}
                                </td>
                            </tr>
                            <tr>
                                <td>Price </td>
                                <td>
                                    ${{ $service->price }}
                                </td>
                            </tr>
                            <tr>
                                <td>Image </td>
                                <td>
                                    <img width="300" src="{{ $service->image_url }}" >
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