<?php $__env->startSection('title'); ?>
    Referral Report
<?php $__env->stopSection(); ?>

<?php $__env->startSection('header_scripts'); ?>
    <link  href="<?php echo e(asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')); ?>" rel="stylesheet">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Referral Report</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?php echo e(route('admin.dashboard')); ?>">Home</a></li>
                        <li class="breadcrumb-item active">Referrals</li>
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
                    <table class="table table-striped projects" id="referral-listing">
                        <thead>
                            <tr>
                                <th style="width: 1%">
                                    #
                                </th>
                                <th style="width: 50%">
                                    User
                                </th>
                                <th style="width: 20%">
                                    Referral Count
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
        $('#referral-listing').DataTable({
            processing: true,
            serverSide: true,
            ajax: '<?php echo e(route("admin.load.referrals")); ?>',
            columns: [
                    { data: 'id', name: 'id', searchable: false },
                    { data: 'name', name: 'name' },
                    { data: 'referrals_count', name: 'referrals_count', searchable: false },
                    { data: 'action', name: 'action', orderable: false, searchable: false },
            ]
        });
    });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home2/securtac/public_html/securtac/resources/views/admin/referrals/index.blade.php ENDPATH**/ ?>