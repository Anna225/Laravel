<?php $__env->startSection('title'); ?>
    Tutorial Slides
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h4 class="m-0 text-dark">Chapter: <?php echo e($chapter->name); ?></h4>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?php echo e(route('admin.dashboard')); ?>">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?php echo e(route('admin.chapters.index')); ?>">Chapters</a></li>
                        <li class="breadcrumb-item active">Tutorial Slides</li>
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
                    <a class="btn btn-primary pull-right" href="<?php echo e(route("admin.slides.create",$chapter->id)); ?>">
                        Add Slide
                    </a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-8">
                    <ul class="list-group" id="slide-list">
                        <?php $__empty_1 = true; $__currentLoopData = $chapter->slides; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $slide): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <li class="draggable-item-list list-group-item d-flex justify-content-between align-items-center" id="slide_<?php echo e($slide->id); ?>">
                                <div class="checkbox">
                                    <i class="fas fa-arrows-alt fa-fw handle" style="cursor:pointer"></i>
                                    <?php echo e($slide->title); ?>

                                </div>
                                <div class="pull-right action-buttons">
                                    <a href="<?php echo e(route('admin.slides.edit',$slide->id)); ?>" title="Edit Slide"><i class="fa-fw fas fa-edit"></i></a> &nbsp;
                                    <a href="#" class="delete-slide" title="Delete Slide"><i class="fa-fw fas fa-trash"></i></a>
                                    <form class="delete-form-" action="<?php echo e(route('admin.slides.delete', $slide->id)); ?>" method="POST" style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <?php echo csrf_field(); ?>
                                    </form>
                                </div>
                            </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <p>No Slides found.<p>
                        <?php endif; ?>
                        
                    </ul>
                </div>
                <!-- /.col-md-12 -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer_scripts'); ?>
<script src="<?php echo e(URL::asset('plugins/jquery-ui/jquery-ui.min.js')); ?>"></script>
<script>
    $(document).ready(function(){
        <?php if($message = Session::get('success')): ?>
            toastr.success('<?php echo e($message); ?>')
        <?php endif; ?>

        <?php if($message = Session::get('error')): ?>
            toastr.error('<?php echo e($message); ?>')
        <?php endif; ?>

        $('.delete-slide').on('click', function(e){
            e.preventDefault();
            if ( confirm("Are you sure want to delete?") ) {
                $(this).next().submit();
            }
        });

        $('#slide-list').sortable({
            axis: 'y',
            handle: ".handle",
            cursor: "move",
            stop : function(event, ui){
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                var data = $(this).sortable('serialize');
                $.ajax({
                    url: "<?php echo e(route('admin.slides.order')); ?>",
                    method: 'POST',
                    data: data,
                    success: function(result){
                        console.log(result);
                    }
                });
            }
        });
    });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home2/securtac/public_html/securtac/resources/views/admin/slides/index.blade.php ENDPATH**/ ?>