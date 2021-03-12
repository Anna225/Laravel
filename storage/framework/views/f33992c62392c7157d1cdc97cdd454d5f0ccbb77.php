<?php $__env->startSection('title'); ?>
    <?php echo e($transaction->name); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?php echo e(route('admin.dashboard')); ?>">Home</a></li>
                        <li class="breadcrumb-item active"><a href="<?php echo e(route('admin.successful.transactions')); ?>">Successful Transactions</a></li>
                        <li class="breadcrumb-item active">Show Details</li>
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
                    <div class="card card-dark">
                        <div class="card-header">
                            <h3 class="card-title">User Details</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <!-- /.row -->
                            <div class="row">
                                <table class="table table-bordered">
                                    <thead>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th>User ID </th>
                                            <td>
                                                <a href="<?php echo e(route('admin.users.show', $transaction->user->id)); ?>"><?php echo e($transaction->user->id); ?></a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>User Name </th>
                                            <td>
                                                <?php echo e($transaction->user->name); ?>

                                            </td>
                                        </tr>
                                        <tr>
                                            <th>User Email </th>
                                            <td>
                                                <a href="<?php echo e(route('admin.users.show', $transaction->user->id)); ?>"><?php echo e($transaction->user->email); ?></a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div><!-- /.card-body -->
                    </div>
                    <div class="card card-dark">
                        <div class="card-header">
                            <h3 class="card-title">Subscription Details</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <!-- /.row -->
                            <div class="row">
                                <table class="table table-bordered">
                                    <thead>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th>Service Name </th>
                                            <td>
                                                <?php echo e($transaction->service_name); ?>

                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Transaction ID </th>
                                            <td>
                                                <?php echo e($transaction->transaction_id); ?>

                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Status </th>
                                            <td>
                                                <?php echo e($transaction->status); ?>

                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Date </th>
                                            <td>
                                                <?php echo e(date('d-m-Y', strtotime($transaction->created_at))); ?>

                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Expiry Date </th>
                                            <td>
                                                <?php echo e(date('d-m-Y', strtotime($transaction->ends_at))); ?>

                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Payment Response </th>
                                            <td style="max-width:250px"><p><?php echo e(json_encode($transaction->payment_response)); ?></p>                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div><!-- /.card-body -->
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home2/securtac/public_html/securtac/resources/views/admin/transactions/show-successful.blade.php ENDPATH**/ ?>