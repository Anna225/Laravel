@extends('admin.layouts.app')

@section('title')

@endsection

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <a href="{{ route('admin.consent-documents.index') }}">Back</a>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.consent-documents.index') }}">Consent Documents</a></li>
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
                <div class="col-md-7">
                    <table class="table table-bordered">
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
                                    <a href="{{ route("get.document", $document->document ) }}" target="_blank">{{ $document->document }}</a>
                                </td>
                            </tr>
                            <tr>
                                <td>Uploaded Date </td>
                                <td>
                                    {{ $document->uploaded_date }}
                                </td>
                            </tr>
                            <tr>
                                <td>Status </td>
                                <td>
                                    <div class="form-group">
                                        <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                                            <input type="checkbox" class="custom-control-input" id="status" name="status" data-id="{{$document->id}}" @if ( $document->status == 'approved' ) checked  @endif>
                                            <label class="custom-control-label" for="status"></label>
                                        </div>
                                    </div>
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

@section('footer_scripts')
<script>
    $(document).ready(function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('#status').change(function(e){
            var action = ( $(this).is(':checked') ) ? 'approved' : 'not_approved';
            var id = $(this).attr('data-id');
            var data = {status:action,id:id};
            $.ajax({
                url: "{{ route('admin.consent-documents.update') }}",
                method: 'POST',
                data: data,
                success: function(result){
                    console.log(result);
                    if ( result.status == 'success' ) {
                        toastr.success(result.msg);  
                    } else {
                        toastr.error(result.msg);
                    }
                },
                error: function (jqXHR, exception) {
                    var msg = '';
                    if (jqXHR.status === 0) {
                        msg = 'Not connect.\n Verify Network.';
                    } else if (jqXHR.status == 404) {
                        msg = 'Requested page not found. [404]';
                    } else if (jqXHR.status == 500) {
                        msg = 'Internal Server Error [500].';
                    } else if (exception === 'parsererror') {
                        msg = 'Requested JSON parse failed.';
                    } else if (exception === 'timeout') {
                        msg = 'Time out error.';
                    } else if (exception === 'abort') {
                        msg = 'Ajax request aborted.';
                    } else {
                        if ( jqXHR.responseText ) {
                            msg = 'Uncaught Error.\n' + jqXHR.responseText.message;
                        } else {
                            msg = 'Uncaught Error.\n' + jqXHR.responseText;
                        }
                    }
                    console.log('Ajax error:'+ msg);
                    toastr.error(msg);
                },
            });
        });
    });    
</script>
@endsection