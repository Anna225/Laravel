<?php $__env->startSection('title'); ?>
    Edit <?php echo e($home_slide->name); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('header_scripts'); ?>
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="<?php echo e(URL::asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <a href="<?php echo e(route('admin.home-slides.index')); ?>">Back</a>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?php echo e(route('admin.dashboard')); ?>">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?php echo e(route('admin.home-slides.index')); ?>">Slides</a></li>
                        <li class="breadcrumb-item active">Edit slide</li>
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
                <div class="col-md-10">

                    <?php echo $__env->make('admin.partials.flash-message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                    <div class="card card-info">
                        <!-- form start -->
                        <form class="form-horizontal" method="POST" enctype="multipart/form-data" action="<?php echo e(route('admin.home-slides.update', [$home_slide->id])); ?>">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('PUT'); ?>
                            <div class="card-body">
                                <div class="form-group row">
                                    <label for="input-heading" class="col-sm-2 col-form-label">Heading</label>
                                    <div class="col-sm-10">
                                        <input name="heading" type="text" class="form-control <?php if ($errors->has('heading')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('heading'); ?> is-invalid <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>" id="input-heading" placeholder="heading" value="<?php echo e($home_slide->heading); ?>" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="input-subheading" class="col-sm-2 col-form-label">Subheading</label>
                                    <div class="col-sm-10">
                                        <textarea rows="4" name="subheading" class="form-control <?php if ($errors->has('subheading')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('subheading'); ?> is-invalid <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>" id="input-subheading"><?php echo e($home_slide->subheading); ?></textarea>
                                    </div>
                                </div>
                                <div class="form-group row ">
                                    <label for="input-cta_label" class="col-sm-2 col-form-label">Button Label</label>
                                    <div class="col-sm-10">
                                        <input name="cta_label" type="text" class="form-control <?php if ($errors->has('cta_label')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('cta_label'); ?> is-invalid <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>" id="input-cta_label" placeholder="Learn More" value="<?php echo e($home_slide->cta_label); ?>">
                                    </div>
                                </div>
                                
                                <div class="form-group row">
                                        <label class="col-sm-2 col-form-label"></label>
                                    <div class="col-sm-10">
                                        <img src="<?php echo e($home_slide->image_url); ?>" class="img-thumbnail" width="100">        
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="image" class="col-sm-2 col-form-label">Image</label>
                                    <div class="col-sm-10">
                                        <div class="custom-file">
                                            <input type="file" name="image" class="custom-file-input" id="image">
                                            <label class="custom-file-label" for="image">Choose file</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="offset-sm-2 col-sm-10">
                                        <button type="submit" class="btn btn-success">Update</button>
                                        <a class="btn btn-primary" href="<?php echo e(route('admin.home-slides.index')); ?>">&nbsp;Back&nbsp;</a>
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
<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home2/securtac/public_html/securtac/resources/views/admin/home-slides/edit.blade.php ENDPATH**/ ?>