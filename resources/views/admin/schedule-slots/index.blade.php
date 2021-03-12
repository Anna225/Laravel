@extends('admin.layouts.app')

@section('title')
    Schedule Slots
@endsection

@section('header_scripts')
    <link  href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endsection

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-8">
                    <h4 class="m-0 text-dark">{{ $service->name }}</h4>
                </div><!-- /.col -->
                <div class="col-sm-4">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.services.slots') }}">Schedule Slots</a></li>
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
                    <a class="btn btn-primary pull-right" href="{{ route("admin.slots.create", $service->id) }}">
                        Add Schedule Slot
                    </a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-striped projects table-responsive" id="slot-listing">
                        <thead>
                            <tr>
                                <th style="width: 1%">
                                    #
                                </th>
                                <th style="width: 50%">
                                    Event
                                </th>
                                <th style="width: 10%">
                                    Start Date
                                </th>
                                <th style="width: 10%">
                                    End Date
                                </th>
                                <th style="width: 10%">
                                    Status
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
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#slot-listing').DataTable({
            processing: true,
            serverSide: true,
            stateSave: true,
            ajax: '{{ route("admin.load.slots", $service->id) }}',
            columns: [
                    { data: 'id', name: 'id' },
                    { data: 'event', name: 'event' },
                    { data: 'start_date', name: 'start_date' },
                    { data: 'end_date', name: 'end_date'},
                    { data: 'status', name: 'status'},
                    { data: 'action', name: 'action', orderable: false, searchable: false },
            ]
        });

        $('#slot-listing').on('click', '.delete-slot', function(e){
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
                    $('#slot-listing').DataTable().draw(false);
                });
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