<?php $__env->startSection('title'); ?>
    Forgot Password | SECURTAC
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="card">
    <div class="card-body login-card-body">
        <?php echo $__env->make('admin.partials.flash-message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <p class="login-box-msg">You forgot your password? Here you can easily retrieve a new password.</p>

        <form action="<?php echo e(route('admin.password.email')); ?>" method="post">

            <?php echo csrf_field(); ?>

            <div class="input-group mb-3">
                <input type="email" name="email" class="form-control <?php if ($errors->has('email')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('email'); ?> is-invalid <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>" value="<?php echo e(old('email')); ?>" placeholder="Email" autocomplete="email" required autofocus>
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-envelope"></span>
                    </div>
                </div>
                <?php if ($errors->has('email')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('email'); ?>
                    <span class="invalid-feedback" role="alert">
                        <strong><?php echo e($message); ?></strong>
                    </span>
                <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>
            </div>
            <div class="row">
                <div class="col-12">
                    <button type="submit" class="btn btn-primary btn-block"><?php echo e(__('Send Password Reset Link')); ?></button>
                </div>
            </div>
        </form>

        <p class="mt-3 mb-1">
            <a href="<?php echo e(route('admin.login')); ?>">Login</a>
        </p>
    </div>
    <!-- /.login-card-body -->
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.auth.app-auth', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home2/securtac/public_html/securtac/resources/views/admin/auth/passwords/email.blade.php ENDPATH**/ ?>