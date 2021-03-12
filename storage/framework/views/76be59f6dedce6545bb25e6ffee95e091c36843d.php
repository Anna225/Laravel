<?php $__env->startSection('title'); ?>
    Add User
<?php $__env->stopSection(); ?>

<?php $__env->startSection('header_scripts'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('plugins/bootstrap-datepicker/bootstrap-datepicker3.min.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h4>Add User</h4>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?php echo e(route('admin.dashboard')); ?>">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?php echo e(route('admin.users.index')); ?>">Users</a></li>
                        <li class="breadcrumb-item active">Add User</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
                <?php echo $__env->make('admin.partials.flash-message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <div class="row">
                <div class="col-md-8">
                    <div class="card card-info">
                        <!-- form start -->
                        <form class="form-horizontal" method="POST" enctype="multipart/form-data" action="<?php echo e(route('admin.users.store')); ?>">
                            <?php echo csrf_field(); ?>
                            <div class="card-body">
                                <div class="form-group row">
                                    <label for="input-first_name" class="col-sm-2 col-form-label">First Name</label>
                                    <div class="col-sm-10">
                                        <input name="first_name" type="text" class="form-control <?php if ($errors->has('first_name')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('first_name'); ?> is-invalid <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>" id="input-first_name" placeholder="First Name" value="<?php echo e(old('first_name')); ?>" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="input-last_name" class="col-sm-2 col-form-label">Last Name</label>
                                    <div class="col-sm-10">
                                        <input name="last_name" type="text" class="form-control <?php if ($errors->has('last_name')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('last_name'); ?> is-invalid <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>" id="input-last_name" placeholder="Last Name" value="<?php echo e(old('last_name')); ?>" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="input-email" class="col-sm-2 col-form-label">Email</label>
                                    <div class="col-sm-10">
                                        <input name="email" type="email" class="form-control <?php if ($errors->has('email')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('email'); ?> is-invalid <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>" id="input-email" placeholder="Email" value="<?php echo e(old('email')); ?>" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="input-password" class="col-sm-2 col-form-label">Password</label>
                                    <div class="col-sm-10">
                                        <input name="password" type="password" class="form-control <?php if ($errors->has('password')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('password'); ?> is-invalid <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>" id="input-password" placeholder="Password" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="input-modilenumber" class="col-sm-2 col-form-label">Mobile Number</label>
                                    <div class="col-sm-10">
                                        <input name="mobile_number" type="number" class="form-control <?php if ($errors->has('mobile_number')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('mobile_number'); ?> is-invalid <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>" id="input-modilenumber" placeholder="Mobile Number" value="<?php echo e(old('mobile_number')); ?>" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="input-dob" class="col-sm-2 col-form-label">Date of birth</label>
                                    <div class="col-sm-10">
                                        <input name="birth_date" type="text" class="form-control <?php if ($errors->has('birth_date')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('birth_date'); ?> is-invalid <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>" id="input-dob" placeholder="Date of Birth" autocomplete="off" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="input-address1" class="col-sm-2 col-form-label">Street</label>
                                    <div class="col-sm-10">
                                        <input name="address_line_1" type="text" class="form-control <?php if ($errors->has('address_line_1')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('address_line_1'); ?> is-invalid <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>" id="input-address1" placeholder="Street Number & Street Name" value="<?php echo e(old('address_line_1')); ?>">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="input-address2" class="col-sm-2 col-form-label">Apartment</label>
                                    <div class="col-sm-10">
                                        <input name="address_line_2" type="text" class="form-control <?php if ($errors->has('address_line_2')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('address_line_2'); ?> is-invalid <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>" id="input-address2" placeholder="Apartment/Unit Number" value="<?php echo e(old('address_line_2')); ?>">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="input-city" class="col-sm-2 col-form-label">City</label>
                                    <div class="col-sm-10">
                                        <input name="city" type="text" class="form-control <?php if ($errors->has('city')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('city'); ?> is-invalid <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>" id="input-city" placeholder="City" value="<?php echo e(old('city')); ?>">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="input-state" class="col-sm-2 col-form-label">State</label>
                                    <div class="col-sm-10">
                                        <input name="state" type="text" class="form-control <?php if ($errors->has('state')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('state'); ?> is-invalid <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>" id="input-state" placeholder="State/Province" value="<?php echo e(old('state')); ?>">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="input-country" class="col-sm-2 col-form-label">Country</label>
                                    <div class="col-sm-10">
                                        <input name="country" type="text" class="form-control <?php if ($errors->has('country')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('country'); ?> is-invalid <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>" id="input-country" placeholder="Country" value="<?php echo e(old('country')); ?>">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="input-postal-code" class="col-sm-2 col-form-label">Postal Code</label>
                                    <div class="col-sm-10">
                                        <input name="postal_code" type="text" class="form-control <?php if ($errors->has('postal_code')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('postal_code'); ?> is-invalid <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>" id="input-postal-code" placeholder="Postal Code" value="<?php echo e(old('postal_code')); ?>">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="input-referralcode" class="col-sm-2 col-form-label">Referral Code</label>
                                    <div class="col-sm-10">
                                        <input name="referral_code" type="text" class="form-control <?php if ($errors->has('referral_code')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('referral_code'); ?> is-invalid <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>" id="input-referralcode" placeholder="Referral Code" value="<?php echo e(old('referral_code')); ?>">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="input-status" class="col-sm-2 col-form-label">Status</label>
                                    <div class="col-sm-10">
                                        <select class="form-control custom-select" name="status">
                                            <option value="1" <?php if(old('status') == "1"): ?> <?php echo e('selected'); ?> <?php endif; ?>>Active</option>
                                            <option value="0" <?php if(old('status') == "0"): ?> <?php echo e('selected'); ?> <?php endif; ?>>Deactive</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="input-status" class="col-sm-2 col-form-label">Services</label>
                                    <div class="col-sm-10">
                                        <?php $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <div class="custom-control custom-checkbox">
                                                <input class="custom-control-input" type="checkbox" name="services[]" id="customCheckbox-<?php echo e($key); ?>" value="<?php echo e($service->id); ?>">
                                                <label for="customCheckbox-<?php echo e($key); ?>" class="custom-control-label"><?php echo e($service->name); ?></label>
                                            </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
                                </div>
                                
                                <div class="form-group row">
                                    <div class="col-sm-10">
                                        <input type="submit" name="submit" class="btn btn-info" value="Save" />
                                        <input type="submit" name="submit" value="Save and Add another" class="btn btn-info">
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </form>
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer_scripts'); ?>
<script src="<?php echo e(asset('plugins/moment/moment.min.js')); ?>"></script>
<script src="<?php echo e(asset('plugins/bootstrap-datepicker/bootstrap-datepicker.min.js')); ?>"></script>

<script>
    $(document).ready(function(){
        <?php if($message = Session::get('success')): ?>
            toastr.success('<?php echo e($message); ?>')
        <?php endif; ?>

        <?php if($message = Session::get('error')): ?>
            toastr.error('<?php echo e($message); ?>')
        <?php endif; ?>

        //$('[data-mask]').inputmask();

        var datePickerOptions = {
            autoclose: true,
            orientation: "bottom auto",
            format: 'dd-mm-yyyy',
        };
        $('#input-dob').datepicker(datePickerOptions);
    });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home2/securtac/public_html/securtac/resources/views/admin/users/create.blade.php ENDPATH**/ ?>