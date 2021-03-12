<?php $__env->startSection('title'); ?>
    Add Chapter
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h4>Add Chapter</h4>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?php echo e(route('admin.dashboard')); ?>">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?php echo e(route('admin.chapters.index')); ?>">Chapters</a></li>
                        <li class="breadcrumb-item active">Add Chapter</li>
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
                <div class="col-md-8">
                    <div class="card card-info">
                        <!-- form start -->
                        <form class="form-horizontal" method="POST" enctype="multipart/form-data" action="<?php echo e(route('admin.chapters.store')); ?>">
                            <?php echo csrf_field(); ?>
                            <div class="card-body">
                                <div class="form-group row">
                                    <label for="input-name" class="col-sm-2 col-form-label">Name</label>
                                    <div class="col-sm-10">
                                        <input name="name" type="text" class="form-control <?php if ($errors->has('name')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('name'); ?> is-invalid <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>" id="input-name" placeholder="Name" value="<?php echo e(old('name')); ?>" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="input-description" class="col-sm-2 col-form-label">Description</label>
                                    <div class="col-sm-10">
                                        <input name="description" type="text" class="form-control <?php if ($errors->has('description')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('description'); ?> is-invalid <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>" id="input-description" placeholder="Description" value="<?php echo e(old('description')); ?>" required>
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
                                    <label for="input-questions" class="col-sm-2 col-form-label">Quiz Questions</label>
                                    <div class="col-sm-10">
                                        <input name="quiz_questions" type="number" class="form-control <?php if ($errors->has('quiz_questions')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('quiz_questions'); ?> is-invalid <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>" id="input-questions" placeholder="No. of Questions in Quiz" value="<?php echo e(old('quiz_questions')); ?>" required>
                                        <small class="text-muted">(Can not be more than total number of questions)</small>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="input-min_pass_marks" class="col-sm-2 col-form-label">Min. Passing Marks</label>
                                    <div class="col-sm-10">
                                        <input name="min_pass_marks" type="number" class="form-control <?php if ($errors->has('min_pass_marks')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('min_pass_marks'); ?> is-invalid <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>" id="input-min_pass_marks" placeholder="Min. Passing Marks" value="<?php echo e(old('min_pass_marks')); ?>" required>
                                        <small class="text-muted">(Can not be more than total number of questions)</small>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="input-time" class="col-sm-2 col-form-label">Study Time (minutes)</label>
                                    <div class="col-sm-10">
                                        <input name="study_time" type="number" class="form-control <?php if ($errors->has('study_time')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('study_time'); ?> is-invalid <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>" id="input-time" placeholder="Minimum study time" value="<?php echo e(old('study_time')); ?>" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-10">                                      
                                        <input type="submit" name="submit" class="btn btn-info" value="Save" />
                                        <input type="submit" name="submit" value="Save and Add another" class="btn btn-info">
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
<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home2/securtac/public_html/securtac/resources/views/admin/chapters/create.blade.php ENDPATH**/ ?>