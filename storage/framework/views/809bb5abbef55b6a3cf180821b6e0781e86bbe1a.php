<?php $__env->startSection('title'); ?>
    Services
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Services</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?php echo e(route('admin.dashboard')); ?>">Home</a></li>
                        <li class="breadcrumb-item active">services</li>
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
                
            </div>
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-striped projects">
                        <thead>
                            <tr>
                                <th style="width: 1%">
                                    #
                                </th>
                                <th style="width: 25%">
                                    Name
                                </th>
                                <th style="width: 40%">
                                    Description
                                </th>
                                <th style="width: 10%">
                                    Price
                                </th>
                                <th>
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td>
                                        <?php echo e($service->id); ?>

                                    </td>
                                    <td>
                                        <?php echo e($service->name ?? ''); ?>

                                    </td>
                                    <td>
                                        <?php echo e($service->description ?? ''); ?>

                                    </td>
                                    
                                    <td>
                                        $<?php echo e($service->price); ?>

                                    </td>
                                    <td class="project-actions ">
                                        <a class="btn btn-primary btn-sm" href="<?php echo e(route('admin.services.show',$service->id)); ?>">
                                            <i class="fas fa-eye">
                                            </i>
                                            View
                                        </a>
                                        <a class="btn btn-info btn-sm" href="<?php echo e(route('admin.services.edit',$service->id)); ?>">
                                            <i class="fas fa-pencil-alt">
                                            </i>
                                            Edit
                                        </a>
                                        
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                    <?php echo e($services->links()); ?>

                </div>
                <!-- /.col-md-12 -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer_scripts'); ?>
<script>
    $(document).ready(function(){
        <?php if($message = Session::get('success')): ?>
            toastr.success('<?php echo e($message); ?>')
        <?php endif; ?>

        <?php if($message = Session::get('error')): ?>
            toastr.error('<?php echo e($message); ?>')
        <?php endif; ?>

        $('.delete-service').on('submit', function(e){
            e.preventDefault();
            if ( confirm("Are you sure want to delete?") ) {
                this.submit();
            }
        });
    });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home2/securtac/public_html/securtac/resources/views/admin/services/index.blade.php ENDPATH**/ ?>