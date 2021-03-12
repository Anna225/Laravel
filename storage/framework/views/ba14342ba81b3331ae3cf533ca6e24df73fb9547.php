<?php $__env->startSection('title'); ?>
    Add Page
<?php $__env->stopSection(); ?>
<?php $__env->startSection('header_scripts'); ?>
<style>
    .ck-editor__editable_inline {
        min-height: 400px;
    }
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h5>Add Page</h5>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?php echo e(route('admin.dashboard')); ?>">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?php echo e(route('admin.pages.index')); ?>">Pages</a></li>
                        <li class="breadcrumb-item active">Add Page</li>
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
                <div class="col-md-12">
                    <div class="card card-info">
                        <!-- form start -->
                        <form class="form-horizontal" method="POST" action="<?php echo e(route('admin.pages.store')); ?>">
                            <?php echo csrf_field(); ?>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="input-title" class="col-form-label">Title</label>
                                    <div class="">
                                        <input name="title" type="text" class="form-control <?php if ($errors->has('title')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('title'); ?> is-invalid <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>" id="input-title" placeholder="Page Title" value="<?php echo e(old('title')); ?>" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="input-content" class="col-form-label">Content</label>
                                    <div class="">
                                        <textarea name="content" type="text" class="form-control" id="input-content" value="<?php echo e(old('content')); ?>" required></textarea>
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

<?php $__env->startSection('footer_scripts'); ?>    
<script src="<?php echo e(asset('vendor/unisharp/laravel-ckeditor/ckeditor.js')); ?>"></script>
<script>
    CKEDITOR.replace( 'input-content',{
        extraPlugins: 'image2,uploadimage',
        filebrowserUploadUrl: "<?php echo e(route('admin.image.upload', ['_token' => csrf_token() ])); ?>",
        filebrowserUploadMethod: 'form',
        height: 500
    } );
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home2/securtac/public_html/securtac/resources/views/admin/pages/create.blade.php ENDPATH**/ ?>