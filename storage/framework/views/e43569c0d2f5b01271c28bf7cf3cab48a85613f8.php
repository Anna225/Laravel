<?php $__env->startSection('content'); ?>
<div class="insite-content">
    <div class="site-part">
        <div class="container">
            <div class="sec-title">
                <h1><?php echo $page->title; ?></h1>
            </div>

            <div class="mt-2"></div>

            <?php echo $page->content; ?>

            
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home2/securtac/public_html/securtac/resources/views/page.blade.php ENDPATH**/ ?>