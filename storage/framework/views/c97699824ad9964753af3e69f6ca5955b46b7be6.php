<?php $__env->startSection('title'); ?>
    Schedule Slots
<?php $__env->stopSection(); ?>

<?php $__env->startSection('header_scripts'); ?>
    <link  href="<?php echo e(asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')); ?>" rel="stylesheet">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-8">
                    <h4 class="m-0 text-dark"><?php echo e($service->name); ?></h4>
                </div><!-- /.col -->
                <div class="col-sm-4">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?php echo e(route('admin.dashboard')); ?>">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?php echo e(route('admin.services.slots')); ?>">Schedule Slots</a></li>
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
                    <a class="btn btn-primary pull-right" href="<?php echo e(route("admin.slots.create", $service->id)); ?>">
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
<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer_scripts'); ?>
<script src="<?php echo e(asset('plugins/datatables/jquery.dataTables.min.js')); ?>"></script>
<script src="<?php echo e(asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')); ?>"></script>
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
            ajax: '<?php echo e(route("admin.load.slots", $service->id)); ?>',
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

        <?php if($message = Session::get('success')): ?>
            toastr.success('<?php echo e($message); ?>')
        <?php endif; ?>

        <?php if($message = Session::get('error')): ?>
            toastr.error('<?php echo e($message); ?>')
        <?php endif; ?>
    });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home2/securtac/public_html/securtac/resources/views/admin/schedule-slots/index.blade.php ENDPATH**/ ?>