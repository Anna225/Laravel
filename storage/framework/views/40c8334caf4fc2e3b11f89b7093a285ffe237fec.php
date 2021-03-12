<?php $__env->startComponent('mail::layout'); ?>
    
    <?php $__env->slot('header'); ?>
        <?php $__env->startComponent('mail::header', ['url' => config('app.url')]); ?>
            <img src="<?php echo e(asset('images/email_site-logo.png')); ?>" alt="Securtac Logo" width="75">
        <?php echo $__env->renderComponent(); ?>
    <?php $__env->endSlot(); ?>

    
    <?php echo e($slot); ?>


    
    
    <?php if(isset($sign)): ?>
        <?php $__env->slot('sign'); ?>
            
        <?php $__env->endSlot(); ?>
    <?php endif; ?>

    
    <?php if(isset($subcopy)): ?>
        <?php $__env->slot('subcopy'); ?>
            <?php $__env->startComponent('mail::subcopy'); ?>
                <?php echo e($subcopy); ?>

            <?php echo $__env->renderComponent(); ?>
        <?php $__env->endSlot(); ?>
    <?php endif; ?>

    
    <?php $__env->slot('footer'); ?>
        <?php $__env->startComponent('mail::footer'); ?>
            © <?php echo e(date('Y')); ?> <?php echo e('Securtac Protection Services Inc.'); ?>. <?php echo app('translator')->getFromJson('All rights reserved.'); ?>
        <?php echo $__env->renderComponent(); ?>
    <?php $__env->endSlot(); ?>
<?php echo $__env->renderComponent(); ?>
<?php /**PATH /home2/securtac/public_html/securtac/resources/views/vendor/mail/html/message.blade.php ENDPATH**/ ?>