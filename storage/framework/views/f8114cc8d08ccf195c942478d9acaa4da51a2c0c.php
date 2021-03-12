<?php $__env->startComponent('mail::message'); ?>
# Hello!

<?php if($type == 'admin'): ?>
New appointment for First Aid CPR is created.
<?php else: ?>
Thanks for booking with us. Below are the details of the course. Cancellations or date changes are subject to the Refund Policy. For any inquries please email us at info@securtac.ca or call us at 416-479-0056
<?php endif; ?>

<?php if( $type == 'admin' ): ?>
### User Details:
<?php $__env->startComponent('mail::table'); ?>
| Name          | Email         | Mobile Number  |
| :------------ |:--------------|:---------------|
| <?php echo e($user->name); ?> | <?php echo e($user->email); ?> | <?php echo e($user->mobile_number); ?> |
<?php echo $__env->renderComponent(); ?>
<?php else: ?>
<?php endif; ?>

### Schedule Details:
<?php $__env->startComponent('mail::table'); ?>
|             |          |
|-------------|------------------------|
|**Event**| <?php echo e($data->slot->event); ?> |
|**Venue**| <?php echo e($data->slot->venue); ?> |
| **Start Date** | <?php echo e(date('d-m-Y',strtotime($data->slot->start_date))); ?> |
| **End Date** | <?php echo e(date('d-m-Y',strtotime($data->slot->end_date))); ?> |
<?php echo $__env->renderComponent(); ?>

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
<?php /**PATH /home2/securtac/public_html/securtac/resources/views/emails/schedules/created.blade.php ENDPATH**/ ?>