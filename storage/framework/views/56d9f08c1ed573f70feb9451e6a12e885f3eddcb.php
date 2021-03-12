<?php $__env->startSection('title'); ?>
    Edit <?php echo e($testimonial->name); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h4>Edit</h4>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?php echo e(route('admin.dashboard')); ?>">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?php echo e(route('admin.testimonials.index')); ?>">Testimonials</a></li>
                        <li class="breadcrumb-item active"><?php echo e($testimonial->name); ?></li>
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
                <div class="col-md-8">

                    <?php echo $__env->make('admin.partials.flash-message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                    <div class="card card-info">
                        <!-- form start -->
                        <form class="form-horizontal" method="POST" enctype="multipart/form-data" action="<?php echo e(route('admin.testimonials.update', [$testimonial->id])); ?>">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('PUT'); ?>
                            <div class="card-body">
                                <div class="form-group row">
                                    <label for="input-name" class="col-sm-2 col-form-label">Name</label>
                                    <div class="col-sm-10">
                                        <input name="name" type="text" class="form-control <?php if ($errors->has('name')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('name'); ?> is-invalid <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>" id="input-name" placeholder="Name" value="<?php echo e($testimonial->name); ?>">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="input-description" class="col-sm-2 col-form-label">Testimony</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control <?php if ($errors->has('text')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('text'); ?> is-invalid <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>" name="text" id="input-text" rows="3"><?php echo e($testimonial->text); ?></textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                        <label class="col-sm-2 col-form-label"></label>
                                    <div class="col-sm-10">
                                        <img src="<?php echo e($testimonial->avatar_url); ?>" class="img-thumbnail" width="100">        
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="image" class="col-sm-2 col-form-label">Image</label>
                                    <div class="col-sm-10">
                                        <div class="custom-file">
                                            <input type="file" name="avatar" class="custom-file-input" id="image">
                                            <label class="custom-file-label" for="image">Choose file</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="offset-sm-2 col-sm-10">
                                        <button type="submit" class="btn btn-success">Update</button>
                                        <a class="btn btn-primary" href="<?php echo e(route('admin.testimonials.index')); ?>">&nbsp;Back&nbsp;</a>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </form>
                    </div>
                </div>
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
    });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home2/securtac/public_html/securtac/resources/views/admin/testimonials/edit.blade.php ENDPATH**/ ?>