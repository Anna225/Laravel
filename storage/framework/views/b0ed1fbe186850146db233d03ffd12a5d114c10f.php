<?php $__env->startSection('title'); ?>
    <?php echo e($chapter->name); ?>

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
                        <li class="breadcrumb-item active"><a href="<?php echo e(route('admin.chapters.index')); ?>">Chapters</a></li>
                        <li class="breadcrumb-item active"><?php echo e($chapter->name); ?></li>
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
                    <a class="btn btn-primary pull-right" href="<?php echo e(route('admin.chapters.edit',$chapter->id)); ?>">
                        Edit Chapter
                    </a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-7">
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <td>Name </td>
                                <td>
                                    <?php echo e($chapter->name); ?>

                                </td>
                            </tr>
                            <tr>
                                <td>Description </td>
                                <td>
                                    <?php echo e($chapter->description); ?>

                                </td>
                            </tr>
                            <tr>
                                <td>Total Quiz Questions </td>
                                <td>
                                    <?php echo e($chapter->quiz_questions); ?>

                                </td>
                            </tr>
                            <tr>
                                <td>Study Time </td>
                                <td>
                                    <?php echo e($chapter->study_time / 60); ?> minutes
                                </td>
                            </tr>
                            <tr>
                                <td>Image </td>
                                <td>
                                    <img width="300" src="<?php echo e($chapter->image_url); ?>">
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
<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home2/securtac/public_html/securtac/resources/views/admin/chapters/show.blade.php ENDPATH**/ ?>