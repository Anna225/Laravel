<?php $__env->startSection('title'); ?>
    Admin Login | SECURTAC
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('admin.partials.flash-message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <div class="card">
        <div class="card-body login-card-body">
            
            <p class="login-box-msg">Sign in to access admin area</p>
            <form action="<?php echo e(route('admin.login.action')); ?>" method="post">
                
                <?php echo csrf_field(); ?>
                
                <div class="input-group mb-3">
                    <input name="email" type="email" class="form-control <?php if ($errors->has('email')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('email'); ?> is-invalid <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>" placeholder="<?php echo e(__('E-Mail Address')); ?>" autocomplete="email" required>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                    <?php if ($errors->has('email')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('email'); ?>
                        <div class="invalid-feedback">
                            <?php echo e($errors->first('email')); ?>

                        </div>
                    <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>
                </div>
                <div class="input-group mb-3">
                    <input name="password" type="password" class="form-control <?php if ($errors->has('password')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('password'); ?> is-invalid <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>" placeholder="Password" autocomplete="current-password" required>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                    <?php if ($errors->has('password')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('password'); ?>
                        <div class="invalid-feedback">
                            <?php echo e($errors->first('password')); ?>

                        </div>
                    <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>
                </div>
                <div class="row">
                    <div class="col-8">
                        
                    </div>
                    <!-- /.col -->
                    <div class="col-4">
                        <button type="submit" class="btn btn-primary btn-block"><?php echo e(__('Sign In')); ?></button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>
            <p class="mb-1">
                <a href="<?php echo e(route('admin.password.request')); ?>">
                    <?php echo e(__('I forgot my password')); ?>

                </a>
            </p>
        </div>
        <!-- /.login-card-body -->
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.auth.app-auth', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home2/securtac/public_html/securtac/resources/views/admin/auth/login.blade.php ENDPATH**/ ?>