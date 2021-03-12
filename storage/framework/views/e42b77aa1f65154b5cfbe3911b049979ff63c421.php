<?php $__env->startComponent('mail::message'); ?>
# Hello <?php echo e($data->user->name); ?>,

Congratulations, You have completed the quiz. Here is the details:

<?php $__env->startComponent('mail::table'); ?>
| | |
|-|-|
<?php if($data->chapter): ?>
| **Chapter** | <?php echo e($data->chapter->name); ?> |
<?php endif; ?>
|**Result**| <?php echo e($data->result_status); ?> |
| **Marks** | <?php echo e($data->total_correct); ?>/<?php echo e($data->total_questions); ?> |
| **Percentage** | <?php echo e($data->percentage); ?> |
| **Time Spent** | <?php echo e(secondsToTime( $data->time_spent )); ?> |
<?php echo $__env->renderComponent(); ?>


Thanks,<br>
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
<?php /**PATH /home2/securtac/public_html/securtac/resources/views/emails/quiz.blade.php ENDPATH**/ ?>