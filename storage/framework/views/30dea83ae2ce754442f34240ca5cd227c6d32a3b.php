<?php $__env->startSection('content'); ?>
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Dashboard</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
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
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-warning">
                    <div class="inner">
                        <h3><?php echo e($data->users->count()); ?></h3>

                        <p>User Registrations</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person-add"></i>
                    </div>
                    <a href="<?php echo e(route('admin.users.index')); ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-md-6">
                    <!-- USERS LIST -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Latest Members</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body p-0">
                            <ul class="users-list clearfix">
                                <?php $__currentLoopData = $data->users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li>
                                        <img src="<?php echo e($user->avatar_url); ?>" alt="User Image" width="80">
                                        <a class="users-list-name" href="<?php echo e(route('admin.users.show', $user->id)); ?>"><?php echo e($user->name); ?></a>
                                        <span class="users-list-date"><?php echo e(\Carbon\Carbon::parse($user->created_at)->format('d-m-Y')); ?></span>
                                    </li>
                                    <?php if($key == 7): ?>
                                        <?php break; ?>
                                    <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                            <!-- /.users-list -->
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer text-center">
                            <a href="<?php echo e(route('admin.users.index')); ?>">View All Users</a>
                        </div>
                        <!-- /.card-footer -->
                    </div>
                    <!--/.card -->
                </div>
                <!-- /.col -->
                <div class="col-md-6">
                    
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home2/securtac/public_html/securtac/resources/views/admin/dashboard.blade.php ENDPATH**/ ?>