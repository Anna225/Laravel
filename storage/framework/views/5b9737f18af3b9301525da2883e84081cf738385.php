<?php $__env->startSection('content'); ?>
<div class="site-content">
    <div class="login-wrapper">
        <div class="login-div">
            <div class="sec-title text-center">
                <h1>Forgot Password</h1>
            </div>
            <?php if(session('status')): ?>
                <div class="alert alert-success" role="alert">
                    <?php echo e(session('status')); ?>

                </div>
            <?php endif; ?>
            <form method="POST" action="<?php echo e(route('password.email')); ?>">
                <?php echo csrf_field(); ?>

                <div class="mt-5">
                    <div class="form-group">
                        <input id="email" type="email" class="form-control <?php if ($errors->has('email')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('email'); ?> is-invalid <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>" name="email" value="<?php echo e(old('email')); ?>" placeholder="Email Address" autocomplete="email" required autofocus>

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
                </div>

                <div class="text-center mt-5">
                    <button class="btn btn-primary" type="submit">Reset Password
                        <i class="icon-arrow-right ml-2"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home2/securtac/public_html/securtac/resources/views/auth/passwords/email.blade.php ENDPATH**/ ?>