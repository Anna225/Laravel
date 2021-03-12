<?php $__env->startSection('title'); ?>
    Pages
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Pages</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?php echo e(route('admin.dashboard')); ?>">Home</a></li>
                        <li class="breadcrumb-item active">Pages</li>
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
                    <a class="btn btn-primary pull-right" href="<?php echo e(route("admin.pages.create")); ?>">
                        Add Page
                    </a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-10">
                    <table class="table table-striped projects table-responsive">
                        <thead>
                            <tr>
                                <th style="width: 1%">
                                    #
                                </th>
                                <th style="width: 70%">
                                    Title
                                </th>
                                <th>
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $pages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td>
                                        <?php echo e($page->id); ?>

                                    </td>
                                    <td>
                                        <?php echo e($page->title); ?>

                                    </td>
                                    <td class="project-actions ">
                                        <a class="btn btn-info btn-sm" href="<?php echo e(route('admin.pages.edit', $page->id)); ?>">
                                            <i class="fas fa-pencil-alt"></i>
                                            Edit
                                        </a>
                                        <form class="delete-page" action="<?php echo e(route('admin.pages.destroy', $page->id)); ?>" method="POST" style="display: inline-block;">
                                            <input type="hidden" name="_method" value="DELETE">
                                            <?php echo csrf_field(); ?>
                                            <input type="submit" class="btn btn-danger btn-sm" value="Delete">
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                    <?php echo e($pages->links()); ?>

                </div>
                <!-- /.col-md-12 -->
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

        $('.delete-page').on('submit', function(e){
            e.preventDefault();
            if ( confirm("Are you sure want to delete?") ) {
                this.submit();
            }
        });
    });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home2/securtac/public_html/securtac/resources/views/admin/pages/index.blade.php ENDPATH**/ ?>