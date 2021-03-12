<?php $__env->startSection('title'); ?>
    Homepage Slides
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h4 class="m-0 text-dark">Homepage Slides</h4>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?php echo e(route('admin.dashboard')); ?>">Home</a></li>
                        <li class="breadcrumb-item active">Home Slides</li>
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
                    <a class="btn btn-primary pull-right" href="<?php echo e(route("admin.home-slides.create")); ?>">
                        Add Slide
                    </a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <ul class="list-group" id="slide-list">
                        <?php $__currentLoopData = $home_slides; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key =>  $slide): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li class="draggable-item-list list-group-item d-flex justify-content-between align-items-center" id="slide_<?php echo e($slide->id); ?>">
                                <div class="checkbox">
                                    <i class="fas fa-arrows-alt fa-fw handle" style="cursor:pointer"></i>
                                    &nbsp;
                                    <img src="<?php echo e($slide->image_url); ?>" width="120" height="60">
                                    &nbsp;
                                    
                                </div>
                                <div class="pull-right action-buttons">
                                    <a href="<?php echo e(route('admin.home-slides.show',$slide->id)); ?>" title="View Slide"><i class="fa-fw fas fa-eye"></i></a> &nbsp; 
                                    <a href="<?php echo e(route('admin.home-slides.edit',$slide->id)); ?>" title="Edit Slide"><i class="fa-fw fas fa-edit"></i></a> &nbsp;
                                    <a href="#" class="delete-slide" title="Delete Slide"><i class="fa-fw fas fa-trash"></i></a>
                                    <form class="delete-form-" action="<?php echo e(route('admin.home-slides.destroy', $slide->id)); ?>" method="POST" style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <?php echo csrf_field(); ?>
                                    </form>
                                </div>
                            </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
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
                    url: "<?php echo e(route('admin.home-slides.order')); ?>",
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
<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home2/securtac/public_html/securtac/resources/views/admin/home-slides/index.blade.php ENDPATH**/ ?>