@extends('admin.layouts.app')

@section('title')
    First Aid Services
@endsection

@section('header_scripts')
{{--     <link  href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet"> --}}
@endsection

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">First Aid CPR Services</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">First Aid Services</li>
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
                <div class="col-md-12">
                    <table class="table table-striped projects table-responsive" id="service-listing">
                        <thead>
                            <tr>
                                <th style="width: 1%">
                                    #
                                </th>
                                <th style="width: 70%">
                                    Service Name
                                </th>
                                <th>
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($services as $service)
                                <tr>
                                    <td>
                                        {{ $service->id }}
                                    </td>
                                    <td>
                                        {{ $service->name }}
                                    </td>
                                    <td class="project-actions ">
                                        <a class="btn btn-info btn-sm" href="{{ route('admin.slots.index', $service->id) }}">
                                            <i class="fas fa-eye-alt"></i>
                                            View Slots
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.col-md-12 -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
@endsection

@section('footer_scripts')
{{-- <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script> --}}
<script>
    $(document).ready(function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        @if ($message = Session::get('success'))
            toastr.success('{{ $message }}')
        @endif

        @if ($message = Session::get('error'))
            toastr.error('{{ $message }}')
        @endif
    });
</script>
@endsection