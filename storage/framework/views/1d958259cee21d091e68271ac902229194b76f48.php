<?php $__env->startSection('content'); ?>
<div class="insite-content">
    <div class="site-part">
        <div class="container">
            <div class="sec-title">
                <h1>Resources</h1>
            </div>
            <table class="table table-responsive-sm mt-4">
                <thead>
                    <tr>
                        <th scope="col" width="5%">#</th>
                        <th scope="col" width="25%">File name</th>
                        <th scope="col" width="60%">Description</th>
                        <th scope="col">&nbsp;</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $resources; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $resource): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <th scope="row"><?php echo e($key + 1); ?></th>
                            <td><?php echo e($resource->name); ?></td>
                            <td><?php echo e($resource->description); ?></td>
                            <td><a href="<?php echo e(route('get.resource', $resource->file)); ?>"><button class="btn btn-primary btn-small">Download</button></a></td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr><td colspan="4" class="text-center"> <strong>There are no resources available right now</strong> </td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home2/securtac/public_html/securtac/resources/views/resources.blade.php ENDPATH**/ ?>