<?php $__env->startSection('title'); ?>
    Edit <?php echo e($slide->title); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <a href="<?php echo e(route('admin.slides.index', $slide->training_chapter_id)); ?>">Back</a>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?php echo e(route('admin.dashboard')); ?>">Home</a></li>
                        <li class="breadcrumb-item active"><a href="<?php echo e(route('admin.slides.index', $slide->training_chapter_id)); ?>">Slides</a></li>
                        <li class="breadcrumb-item active">Edit <?php echo e($slide->title); ?></li>
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
                        <form class="form-horizontal" method="POST" action="<?php echo e(route('admin.slides.update', [$slide->id])); ?>">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('PUT'); ?>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="input-title" class="col-form-label">Title</label>
                                    <input name="title" type="text" class="form-control <?php if ($errors->has('title')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('title'); ?> is-invalid <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>" id="input-title" placeholder="Slide Title" value="<?php echo e($slide->title); ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="input-content" class="col-form-label">Content</label>
                                    <textarea name="content" type="text" class="form-control" id="input-content" value="<?php echo e(old('content')); ?>" required><?php echo e(html_entity_decode( $slide->content )); ?></textarea>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-10">
                                        <button type="submit" class="btn btn-success">Update</button>
                                        <input type="hidden" name="chapter_id" value=<?php echo e($slide->training_chapter_id); ?> />
                                        <a class="btn btn-primary" href="<?php echo e(route('admin.slides.index',$slide->training_chapter_id)); ?>">&nbsp;Back&nbsp;</a>
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
    $(document).ready(function(){
        <?php if($message = Session::get('success')): ?>
            toastr.success('<?php echo e($message); ?>')
        <?php endif; ?>

        <?php if($message = Session::get('error')): ?>
            toastr.error('<?php echo e($message); ?>')
        <?php endif; ?>
    });

    CKEDITOR.replace( 'input-content',{
        extraPlugins: 'image2,uploadimage',
        filebrowserUploadUrl: "<?php echo e(route('admin.image.upload', ['_token' => csrf_token() ])); ?>",
        filebrowserUploadMethod: 'form',
        height: 500,
        allowedContent:true
    } );
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home2/securtac/public_html/securtac/resources/views/admin/slides/edit.blade.php ENDPATH**/ ?>