<?php $__env->startSection('title'); ?>
    Edit Question
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
                    <a href="<?php echo e(route('admin.questions',$question->training_chapter_id)); ?>">Back</a>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?php echo e(route('admin.dashboard')); ?>">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?php echo e(route('admin.questions',$question->training_chapter_id)); ?>">Questions</a></li>
                        <li class="breadcrumb-item active">Edit Question</li>
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
                        <form class="form-horizontal" method="POST" action="<?php echo e(route('admin.questions.update', $question->id)); ?>">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('PUT'); ?>
                            <div class="card-body">
                                <div class="form-group row">
                                    <label for="input-question" class="col-sm-2 col-form-label">Question</label>
                                    <div class="col-sm-10">
                                        <input name="question" type="text" class="form-control <?php if ($errors->has('question')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('question'); ?> is-invalid <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>" id="input-question" placeholder="Question" value="<?php echo e($question->question); ?>" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="offset-sm-2 col-sm-10">
                                        <input type="hidden" name="training_chapter_id" value="<?php echo e($question->training_chapter_id); ?>">
                                        <button type="submit" class="btn btn-success">Update</button>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </form>
                    </div>
                    <!-- /.card card-info- -->
                    <div class="card">
                        <form action="<?php echo e(route('admin.options.update', $question->id)); ?>" method="POST" class="form-horizontal option-form">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('PUT'); ?>
                            <div class="card-header">
                                <h3 class="card-title">
                                        <i class="fas fa-list-alt"></i>
                                    Options
                                </h3>
                            </div>
                            <div class="card-body">
                                <div class="form-group row single-option">
                                    <label for="input-option1" class="col-form-label">A</label>
                                    <div class="col-sm-10">
                                        <input name="options[]" type="text" class="form-control <?php if ($errors->has('option')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('option'); ?> is-invalid <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>" id="input-option1" placeholder="Option" value="<?php echo e($question->options[0]->option ?? ''); ?>" required>
                                    </div>
                                    <div class="icheck-primary d-inline">
                                        <input type="radio" name="is_correct" id="answer-0" value="0" required
                                        <?php if( isset($question->options[0]) && $question->options[0]->is_correct ): ?>
                                            checked
                                        <?php endif; ?>
                                        >
                                        <label for="answer-0"></label>
                                    </div>
                                </div>
                                <div class="form-group row single-option">
                                    <label for="input-option2" class="col-sm-0 col-form-label">B</label>
                                    <div class="col-sm-10">
                                        <input name="options[]" type="text" class="form-control <?php if ($errors->has('option')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('option'); ?> is-invalid <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>" id="input-option2" placeholder="Option" value="<?php echo e($question->options[1]->option ?? ''); ?>" required>
                                    </div>
                                    <div class="icheck-primary d-inline">
                                        <input type="radio" name="is_correct" id="answer-1" value="1" required
                                        <?php if( isset($question->options[1]) && $question->options[1]->is_correct ): ?>
                                            checked
                                        <?php endif; ?> 
                                        >
                                        <label for="answer-1"></label>
                                    </div>
                                </div>
                                <div class="form-group row single-option">
                                    <label for="input-option3" class="col-sm-0 col-form-label">C</label>
                                    <div class="col-sm-10">
                                        <input name="options[]" type="text" class="form-control <?php if ($errors->has('option')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('option'); ?> is-invalid <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>" id="input-option3" placeholder="Option" value="<?php echo e($question->options[2]->option ?? ''); ?>" required>
                                    </div>
                                    <div class="icheck-primary d-inline">
                                        <input type="radio" name="is_correct" id="answer-2" value="2" required 
                                        <?php if( isset($question->options[2]) && $question->options[2]->is_correct ): ?>
                                            checked
                                        <?php endif; ?>
                                        >
                                        <label for="answer-2"></label>
                                    </div>
                                </div>
                                <div class="form-group row single-option">
                                    <label for="input-option4" class="col-sm-0 col-form-label">D</label>
                                    <div class="col-sm-10">
                                        <input name="options[]" type="text" class="form-control <?php if ($errors->has('option')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('option'); ?> is-invalid <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>" id="input-option4" placeholder="Option" value="<?php echo e($question->options[3]->option ?? ''); ?>" required>
                                    </div>
                                    <div class="icheck-primary d-inline">
                                        <input type="radio" name="is_correct" id="answer-3" value="3" required 
                                        <?php if( isset($question->options[3]) && $question->options[3]->is_correct ): ?>
                                            checked
                                        <?php endif; ?>
                                        >
                                        <label for="answer-3"></label>
                                    </div>
                                </div>
                                <div class="form-group row add-more-wrap">
                                    <div class="col-sm-10">
                                        <input type="hidden" name="training_chapter_id" value="<?php echo e($question->training_chapter_id); ?>">
                                        <input type="hidden" name="question_id" value="<?php echo e($question->id); ?>">
                                        <button class="btn btn-success" id="add-more">Update</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- /.card card-info- -->
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
<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home2/securtac/public_html/securtac/resources/views/admin/questions/edit.blade.php ENDPATH**/ ?>