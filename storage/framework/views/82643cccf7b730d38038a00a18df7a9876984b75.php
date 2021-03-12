<?php $__env->startComponent('mail::message'); ?>
# Hello <?php echo e($data->first_name.' '.$data->last_name); ?>,

##Congratulations, You have completed all the chapters you can proceed with Final Quiz.


<?php $__env->startComponent('mail::sign'); ?>
    <?php $__env->slot('site_logo'); ?>
        <img src="<?php echo e(asset('images/email_site-logo.png')); ?>" alt="Securtac Logo" width="50">
    <?php $__env->endSlot(); ?>

    <?php $__env->slot('facebook_img'); ?>
        <img src="<?php echo e(asset('images/email_facebook.png')); ?>" alt="Facebook Logo" width="24">
    <?php $__env->endSlot(); ?>

    <?php $__env->slot('instagram_img'); ?>
        <img src="<?php echo e(asset('images/email_instagram.png')); ?>" alt="Instagram Logo" width="24">
    <?php $__env->endSlot(); ?>

    1691 McCowan Rd. Unit 101 <br>
    Toronto, Ontario <br>
    M1S 2Y3 <br>
    Tel: 416-479-0056<br>
    <a href="https://securtac.ca">www.securtac.ca</a>
<?php echo $__env->renderComponent(); ?>
<?php echo $__env->renderComponent(); ?>
<?php /**PATH /home2/securtac/public_html/securtac/resources/views/emails/final_quiz_reminder.blade.php ENDPATH**/ ?>