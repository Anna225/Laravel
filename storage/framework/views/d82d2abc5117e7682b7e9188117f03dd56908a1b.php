<?php $__env->startSection('title'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <a href="<?php echo e(route('admin.consent-documents.index')); ?>">Back</a>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?php echo e(route('admin.dashboard')); ?>">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?php echo e(route('admin.consent-documents.index')); ?>">Consent Documents</a></li>
                        <li class="breadcrumb-item active"><?php echo e($document->user->name); ?></li>
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
                                    <?php echo e($document->user->name); ?>

                                </td>
                            </tr>
                            <tr>
                                <td>Document </td>
                                <td>
                                    <a href="<?php echo e(route("get.document", $document->document )); ?>" target="_blank"><?php echo e($document->document); ?></a>
                                </td>
                            </tr>
                            <tr>
                                <td>Uploaded Date </td>
                                <td>
                                    <?php echo e($document->uploaded_date); ?>

                                </td>
                            </tr>
                            <tr>
                                <td>Status </td>
                                <td>
                                    <div class="form-group">
                                        <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                                            <input type="checkbox" class="custom-control-input" id="status" name="status" data-id="<?php echo e($document->id); ?>" <?php if( $document->status == 'approved' ): ?> checked  <?php endif; ?>>
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

<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer_scripts'); ?>
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
                url: "<?php echo e(route('admin.consent-documents.update')); ?>",
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
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home2/securtac/public_html/securtac/resources/views/admin/consent-documents/show.blade.php ENDPATH**/ ?>