<?php $__env->startSection('title'); ?>
    Edit <?php echo e($page->title); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <a href="<?php echo e(route('admin.pages.index')); ?>">Back</a>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?php echo e(route('admin.dashboard')); ?>">Home</a></li>
                        <li class="breadcrumb-item active"><a href="<?php echo e(route('admin.pages.index')); ?>">Pages</a></li>
                        <li class="breadcrumb-item active">Edit <?php echo e($page->title); ?></li>
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
                <div class="col-md-12">
                    <div class="card card-info">
                        <!-- form start -->
                        <form class="form-horizontal" method="POST" action="<?php echo e(route('admin.pages.update', [$page->id])); ?>">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('PUT'); ?>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="input-title" class="col-form-label">Title</label>
                                    <input name="title" type="text" class="form-control <?php if ($errors->has('title')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('title'); ?> is-invalid <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>" id="input-title" placeholder="Page Title" value="<?php echo e($page->title); ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="input-slug" class="col-form-label">slug</label>
                                    <input name="slug" type="text" class="form-control <?php if ($errors->has('slug')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('slug'); ?> is-invalid <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>" id="input-slug" placeholder="Page Slug" value="<?php echo e($page->slug); ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="input-content" class="col-form-label">Content</label>
                                    <textarea name="content" type="text" class="form-control" id="input-content" value="<?php echo e(old('content')); ?>" required><?php echo e(html_entity_decode( $page->content )); ?></textarea>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-10">
                                        <button type="submit" class="btn btn-success">Update</button>
                                        <a class="btn btn-primary" href="<?php echo e(route('admin.pages.index')); ?>">&nbsp;Back&nbsp;</a>
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
<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home2/securtac/public_html/securtac/resources/views/admin/pages/edit.blade.php ENDPATH**/ ?>