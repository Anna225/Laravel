<?php $__env->startSection('title'); ?>
    Add Slide
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
                    <h4>Add Slide</h4>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?php echo e(route('admin.dashboard')); ?>">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?php echo e(route('admin.home-slides.index')); ?>">Homepage Slides</a></li>
                        <li class="breadcrumb-item active">Add Slide</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <?php echo $__env->make('admin.partials.flash-message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <div class="row">
                <div class="col-md-10">
                    <div class="card card-info">
                        <!-- form start -->
                        <form class="form-horizontal" method="POST" enctype="multipart/form-data" action="<?php echo e(route('admin.home-slides.store')); ?>">
                            <?php echo csrf_field(); ?>
                            <div class="card-body">
                                <div class="form-group row">
                                    <label for="input-heading" class="col-sm-2 col-form-label">Heading</label>
                                    <div class="col-sm-10">
                                        <input name="heading" type="text" class="form-control <?php if ($errors->has('heading')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('heading'); ?> is-invalid <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>" id="input-heading" placeholder="heading" value="<?php echo e(old('heading')); ?>" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="input-subheading" class="col-sm-2 col-form-label">Subheading</label>
                                    <div class="col-sm-10">
                                        <textarea name="subheading" class="form-control <?php if ($errors->has('subheading')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('subheading'); ?> is-invalid <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>" id="input-subheading"><?php echo e(old('subheading')); ?></textarea>
                                    </div>
                                </div>
                                <div class="form-group row ">
                                    <label for="input-cta_label" class="col-sm-2 col-form-label">Button Label</label>
                                    <div class="col-sm-10">
                                        <input name="cta_label" type="text" class="form-control <?php if ($errors->has('cta_label')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('cta_label'); ?> is-invalid <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>" id="input-cta_label" placeholder="Learn More" value="<?php echo e(old('cta_label')); ?>">
                                    </div>
                                </div>
                                
                                <div class="form-group row">
                                    <label for="input-image" class="col-sm-2 col-form-label">Image</label>
                                    <div class="col-sm-10">
                                        <div class="custom-file">
                                            <input type="file" name="image" class="custom-file-input" id="input-image" required>
                                            <label class="custom-file-label" for="input-image">Choose file</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-10">
                                        <input type="submit" name="submit" class="btn btn-info" value="Save" />
                                        <input type="submit" name="submit" class="btn btn-info" value="Save and Add another">
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
<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home2/securtac/public_html/securtac/resources/views/admin/home-slides/create.blade.php ENDPATH**/ ?>