<?php $__env->startSection('title'); ?>
Referral Details
<?php $__env->stopSection(); ?>

<?php $__env->startSection('header_scripts'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')); ?>" rel="stylesheet">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h4>Referral Details</h4>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?php echo e(route('admin.dashboard')); ?>">Home</a></li>
                        <li class="breadcrumb-item active"><?php echo e($user->name); ?></li>
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
                <div class="col-md-3">
                    <!-- Profile Image -->
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                            <img class="profile-user-img img-fluid img-circle" src="<?php echo e($user->avatar_url); ?>"
                                alt="User profile picture">
                            </div>
                            <h3 class="profile-username text-center"><?php echo e($user->name); ?></h3>
                            <a href="<?php echo e(route('admin.users.show', $user->id)); ?>" class="btn btn-primary btn-block">Details</a>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->    
                </div>
                <div class="col-md-5">
                    <table class="table table-bordered ">
                        <tbody>
                            <tr>
                                <td>Name: </td>
                                <td>
                                    <?php echo e($user->name); ?>

                                </td>
                            </tr>
                            <tr>
                                <td>Email: </td>
                                <td>
                                    <a href="mailto:<?php echo e($user->email); ?>"><?php echo e($user->email); ?></a>
                                </td>
                            </tr>
                            <tr>
                                <td>Mobile Number: </td>
                                <td>
                                    <?php echo e($user->mobile_number); ?>

                                </td>
                            </tr>
                            <tr>
                                <td>Total Referral: </td>
                                <td>
                                    <?php echo e($user->referrals_count); ?>

                                </td>
                            </tr>
                            <tr>
                                <td>Total Invited: </td>
                                <td>
                                    <?php echo e($user->invites_count); ?>

                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-hover" id="referral-listings">
                        <thead>
                            <tr>
                                <th style="width: 1%">ID</th>
                                <th style="width: 20%">First Name</th>
                                <th style="width: 20%">Last Name</th>
                                <th style="width: 60%">Email</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
            <!-- /.row -->
            <div class="row">
                
            </div>
            <br />
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer_scripts'); ?>
<script src="<?php echo e(asset('plugins/moment/moment.min.js')); ?>"></script>
<script src="<?php echo e(asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')); ?>"></script>
<script src="<?php echo e(asset('plugins/datatables/jquery.dataTables.min.js')); ?>"></script>
<script src="<?php echo e(asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')); ?>"></script>
<script>
    $(document).ready(function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#referral-listings').DataTable({
            processing: true,
            serverSide: true,
            ajax: '<?php echo e(route("admin.load.referral_users", $user->id)); ?>',
            columns: [
                    { data: 'id', name: 'id' },
                    { data: 'first_name', name: 'first_name' },
                    { data: 'last_name', name: 'last_name' },
                    { data: 'email', name: 'email' },
                    { data: 'created_at', name: 'created_at' },
            ]
        });
    });

</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home2/securtac/public_html/securtac/resources/views/admin/referrals/details.blade.php ENDPATH**/ ?>