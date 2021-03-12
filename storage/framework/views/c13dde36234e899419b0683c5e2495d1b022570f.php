<?php $__env->startSection('content'); ?>
<div class="insite-content">
    <div class="site-part">
        <div class="container">
            <div class="sec-title">
                <h1>Invited Users</h1>
            </div>
            <table class="table table-responsive-sm mt-4">
                <thead>
                    <tr>
                        <th scope="col" width="5%">#</th>
                        <th scope="col" width="75%">Email</th>
                        <th scope="col">Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $invitedUsers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <th scope="row"><?php echo e($key + 1); ?></th>
                            <td><?php echo e($user->invite_email); ?></td>
                            <td>
                            <?php if( $user->is_registered ): ?>
                                <span class="badge badge-success">Registered</span>
                            <?php else: ?>
                                <span class="badge badge-danger">Not Registered</span>
                            <?php endif; ?></td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr><td colspan="3" class="text-center"> <strong>You haven't invited any users yet.</strong> </td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        <div class="container">
            <?php echo $__env->make('partials.referral_block', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home2/securtac/public_html/securtac/resources/views/refer.blade.php ENDPATH**/ ?>