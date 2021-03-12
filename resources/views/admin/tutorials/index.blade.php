@extends('admin.layouts.app')

@section('title')
    Tutorials
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
                    <h1 class="m-0 text-dark">Tutorials</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Tutorials</li>
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
                    <a class="btn btn-primary pull-right" href="{{ route("admin.tutorials.create") }}">
                        Add Tutorial
                    </a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-striped projects table-responsive" id="tutorial-lisiting">
                        <thead>
                            <tr>
                                <th style="width: 1%">
                                    #
                                </th>
                                <th style="width: 30%">
                                    Tutorial
                                </th>
                                <th style="width: 30%">
                                    Chapter
                                </th>
                                <th>
                                    Total Slides
                                </th>
                                <th>
                                    Action
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

    $('#tutorial-lisiting').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{ route("admin.load.tutorials") }}',
        columns: [
                { data: 'id', name: 'id' },
                { data: 'name', name: 'name' },
                { data: 'chapter', name: 'chapter' },
                { data: 'total_slides', name: 'total_aslides', searchable: false },
                { data: 'action', name: 'action', orderable: false, searchable: false },
        ]
    });

    $('#tutorial-lisiting').on('click', '.delete-tutorial', function(e){
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
                $('#tutorial-lisiting').DataTable().draw(false);
            });
        }
    });
});
</script>
@endsection