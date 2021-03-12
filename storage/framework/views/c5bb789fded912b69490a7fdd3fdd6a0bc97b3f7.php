<?php $__env->startSection('title'); ?>
    Profile
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Profile</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?php echo e(route('admin.dashboard')); ?>">Home</a></li>
                        <li class="breadcrumb-item active">Profile</li>
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
                            <img class="profile-user-img img-fluid img-circle" src="<?php echo e($admin->avatar_url); ?>"
                                alt="User profile picture">
                            </div>
            
                            <h3 class="profile-username text-center"><?php echo e($admin->name); ?></h3>
                            <a href="<?php echo e(route('admin.profile.edit')); ?>" class="btn btn-primary btn-block">Edit</a>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->    
                </div>
                <div class="col-md-5">
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <td>Name: </td>
                                <td>
                                    <?php echo e($admin->name); ?>

                                </td>
                            </tr>
                            <tr>
                                <td>Email: </td>
                                <td>
                                    <?php echo e($admin->email); ?>

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
<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer_scripts'); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home2/securtac/public_html/securtac/resources/views/admin/profile/show.blade.php ENDPATH**/ ?>