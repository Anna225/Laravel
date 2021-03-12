<?php $__env->startSection('content'); ?>
<div class="site-content">

    <div class="login-wrapper">
        <div class="login-div">
            <div class="sec-title text-center">
                <h1><?php echo e(__('Login')); ?></h1>
            </div>
            <form action="<?php echo e(route('login')); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <div class="mt-5">
                    <div class="form-group">
                        <input id="email" type="email" class="form-control <?php if ($errors->has('email')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('email'); ?> is-invalid <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>" name="email" value="<?php echo e(old('email')); ?>" autocomplete="email" placeholder="Email Address" autofocus required>
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

                    <div class="form-group">
                        <input id="password" type="password" class="form-control <?php if ($errors->has('password')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('password'); ?> is-invalid <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>" name="password" autocomplete="current-password" placeholder="Password" required>

                        <?php if ($errors->has('password')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('password'); ?>
                            <span class="invalid-feedback" role="alert">
                                <strong><?php echo e($message); ?></strong>
                            </span>
                        <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>
                    </div>
                    
                    <p class="text-right">
                        <a href="<?php echo e(route('password.request')); ?>" class="site-link"><?php echo e(__('Forgot Password?')); ?></a>
                    </p>
                </div>

                <div class="text-center mt-5">
                    <a href="course.html">
                        <button class="btn btn-primary" type="submit">Login
                            <i class="icon-arrow-right ml-2"></i>
                        </button>
                    </a>

                    <p class="text-center mt-3 mb-0 fw-700">
                        Do not have login, click here to <a href="<?php echo e(route('register')); ?>" class="theme-link">Register</a>
                    </p>
                </div>
            </form>
        </div>
    </div>

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home2/securtac/public_html/securtac/resources/views/auth/login.blade.php ENDPATH**/ ?>