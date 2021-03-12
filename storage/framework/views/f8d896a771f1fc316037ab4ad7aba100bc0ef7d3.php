<?php $__env->startComponent('mail::message'); ?>
# Hello <?php echo e($data->user->name); ?>, 

Below are the new details of the course. Cancellations or date changes are subject to the Refund Policy. For any inquries please email us at info@securtac.ca or call us at 416-479-0056

### New Schedule Details:
<?php $__env->startComponent('mail::table'); ?>
|             |                        |
|-------------|------------------------|
|**Event**| <?php echo e($data->schedule_slot->event); ?> |
|**Venue**| <?php echo e($data->schedule_slot->venue); ?> |
| **Start Date** | <?php echo e(date('d-m-Y',strtotime($data->schedule_slot->start_date))); ?> |
| **End Date** | <?php echo e(date('d-m-Y',strtotime($data->schedule_slot->end_date))); ?> |
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
<?php /**PATH /home2/securtac/public_html/securtac/resources/views/emails/schedules/reschedule.blade.php ENDPATH**/ ?>