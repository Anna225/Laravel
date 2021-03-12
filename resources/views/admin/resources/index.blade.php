@extends('admin.layouts.app')

@section('title')
    Resources
@endsection

@section('header_scripts')
    <link  href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endsection

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Resources</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Resources</li>
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
                    <a class="btn btn-primary pull-right" href="{{ route("admin.resources.create") }}">
                        Add Resource
                    </a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-striped projects" id="resource-listing">
                        <thead>
                            <tr>
                                <th style="width: 1%">
                                    #
                                </th>
                                <th style="width: 30%">
                                    File Name
                                </th>
                                <th style="width: 50%">
                                    File
                                </th>
                                <th>
                                    Actions
                                </th>
                            </tr>
                        </thead>
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
<script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script>
    $(document).ready(function(){
        @if ($message = Session::get('success'))
            toastr.success('{{ $message }}')
        @endif

        @if ($message = Session::get('error'))
            toastr.error('{{ $message }}')
        @endif

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#resource-listing').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ route("admin.load.resources") }}',
            columns: [
                    { data: 'id', name: 'id', searchable: false },
                    { data: 'name', name: 'name'},
                    { data: 'file', name: 'file', orderable: false, searchable: false },
                    { data: 'action', name: 'action', orderable: false, searchable: false },
            ]
        });

        $('#resource-listing').on('click', '.delete-resource', function(e){
            e.preventDefault();
            var url = $(this).data('remote');
            if ( confirm("Are you sure want to delete?") ) {
                $.ajax({
                    url: url,
                    type: 'POST',
                    dataType: 'json',
                    data: {_method: 'DELETE'}
                }).always(function (data) {
                    if ( data.status == 'success' ) {
                        toastr.success(data.message)    
                    } else {
                        toastr.error(data.message)
                    }
                    $('#resource-listing').DataTable().draw(false);
                });
            }
        });
    });
</script>
@endsection