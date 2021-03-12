<?php $__env->startSection('title'); ?>
    Users
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

                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?php echo e(route('admin.dashboard')); ?>">Home</a></li>
                        <li class="breadcrumb-item active"><a href="<?php echo e(route('admin.users.index')); ?>">Users</a></li>
                        <li class="breadcrumb-item active"><?php echo e($user->name); ?></li>
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
                <div class="col-md-3">
                    <!-- Profile Image -->
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                <img class="profile-user-img img-fluid img-circle" src="<?php echo e($user->avatar_url); ?>" alt="User profile picture">
                            </div>

                            <h3 class="profile-username text-center"><?php echo e($user->name); ?></h3>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->    
                </div>
                <div class="col-md-8">
                    <div class="card card-info">
                        <!-- form start -->
                        <form class="form-horizontal" method="POST" enctype="multipart/form-data" action="<?php echo e(route('admin.users.update', [$user->id])); ?>">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('PUT'); ?>
                            <div class="card-body">
                                <div class="form-group row">
                                    <label for="input-first_name" class="col-sm-2 col-form-label">First Name</label>
                                    <div class="col-sm-10">
                                        <input name="first_name" type="text" class="form-control <?php if ($errors->has('first_name')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('first_name'); ?> is-invalid <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>" id="input-first_name" placeholder="First Name" value="<?php echo e($user->first_name); ?>" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="input-last_name" class="col-sm-2 col-form-label">Last Name</label>
                                    <div class="col-sm-10">
                                        <input name="last_name" type="text" class="form-control <?php if ($errors->has('last_name')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('last_name'); ?> is-invalid <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>" id="input-last_name" placeholder="Last Name" value="<?php echo e($user->last_name); ?>" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="input-email" class="col-sm-2 col-form-label">Email</label>
                                    <div class="col-sm-10">
                                        <input name="email" type="email" class="form-control <?php if ($errors->has('email')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('email'); ?> is-invalid <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>" id="input-email" placeholder="Email" value="<?php echo e($user->email); ?>" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="input-password" class="col-sm-2 col-form-label">Password</label>
                                    <div class="col-sm-10">
                                        <input name="new_password" type="password" class="form-control <?php if ($errors->has('password')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('password'); ?> is-invalid <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>" id="input-password" placeholder="Password">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="input-modilenumber" class="col-sm-2 col-form-label">Mobile Number</label>
                                    <div class="col-sm-10">
                                        <input name="mobile_number" type="text" class="form-control <?php if ($errors->has('mobile_number')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('mobile_number'); ?> is-invalid <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>" id="input-modilenumber" placeholder="Mobile Number" value="<?php echo e($user->mobile_number); ?>" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="input-dob" class="col-sm-2 col-form-label">Date of birth</label>
                                    <div class="col-sm-10">
                                        <input name="birth_date" type="text" class="form-control <?php if ($errors->has('birth_date')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('birth_date'); ?> is-invalid <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>" id="input-dob" placeholder="Date of Birth" value="<?php echo e(date('d-m-Y', strtotime($user->birth_date))); ?>" autocomplete="off" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="input-address1" class="col-sm-2 col-form-label">Street</label>
                                    <div class="col-sm-10">
                                        <input name="address_line_1" type="text" class="form-control <?php if ($errors->has('address_line_1')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('address_line_1'); ?> is-invalid <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>" id="input-address1" placeholder="Street Number & Street Name" value="<?php echo e($user->address_line_1); ?>">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="input-address2" class="col-sm-2 col-form-label">Apartment</label>
                                    <div class="col-sm-10">
                                        <input name="address_line_2" type="text" class="form-control <?php if ($errors->has('address_line_2')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('address_line_2'); ?> is-invalid <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>" id="input-address2" placeholder="Apartment/Unit Number" value="<?php echo e($user->address_line_2); ?>">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="input-city" class="col-sm-2 col-form-label">City</label>
                                    <div class="col-sm-10">
                                        <input name="city" type="text" class="form-control <?php if ($errors->has('city')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('city'); ?> is-invalid <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>" id="input-city" placeholder="City" value="<?php echo e($user->city); ?>">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="input-state" class="col-sm-2 col-form-label">State</label>
                                    <div class="col-sm-10">
                                        <input name="state" type="text" class="form-control <?php if ($errors->has('state')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('state'); ?> is-invalid <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>" id="input-state" placeholder="State/Province" value="<?php echo e($user->state); ?>">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="input-country" class="col-sm-2 col-form-label">Country</label>
                                    <div class="col-sm-10">
                                        <input name="country" type="text" class="form-control <?php if ($errors->has('country')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('country'); ?> is-invalid <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>" id="input-country" placeholder="Country" value="<?php echo e($user->country); ?>">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="input-postal-code" class="col-sm-2 col-form-label">Postal Code</label>
                                    <div class="col-sm-10">
                                        <input name="postal_code" type="text" class="form-control <?php if ($errors->has('postal_code')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('postal_code'); ?> is-invalid <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>" id="input-postal-code" placeholder="Postal Code" value="<?php echo e($user->postal_code); ?>">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="input-referralcode" class="col-sm-2 col-form-label">Referral Code</label>
                                    <div class="col-sm-10">
                                        <input name="referral_code" type="text" class="form-control <?php if ($errors->has('referral_code')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('referral_code'); ?> is-invalid <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>" id="input-referralcode" placeholder="Referral Code" value="<?php echo e($user->referral_code); ?>">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="input-consentdocument" class="col-sm-2 col-form-label">Consent Document</label>
                                    <div class="col-sm-10">
                                        <div class="custom-file">
                                            <input type="file" name="consent_document" class="custom-file-input" id="consent_document">
                                            <label class="custom-file-label" for="input-consentdocument">Choose file</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="input-CPRcertificate" class="col-sm-2 col-form-label">CPR Certificate</label>
                                    <div class="col-sm-10">
                                        <div class="custom-file">
                                            <input type="file" name="cpr_certificate" class="custom-file-input" id="cpr_certificate">
                                            <label class="custom-file-label" for="input-CPRcertificate">Choose file</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="input-status" class="col-sm-2 col-form-label">Status</label>
                                    <div class="col-sm-10">
                                        <select class="form-control custom-select" name="status">
                                            <option value="1" <?php if($user->status == "1"): ?> <?php echo e('selected'); ?> <?php endif; ?>>Activate</option>
                                            <option value="0" <?php if($user->status == "0"): ?> <?php echo e('selected'); ?> <?php endif; ?>>Deactivate</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="input-status" class="col-sm-2 col-form-label">Services</label>
                                    <div class="col-sm-10">
                                        <?php $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php if( isSubscribedUser( $service->id, $user->id ) && isSubscribedUser( $service->id, $user->id )->status == 'subscribed' ): ?>
                                                <div class="custom-control custom-checkbox">
                                                    <input disabled id="service-<?php echo e($service->id); ?>" checked type="checkbox" class="custom-control-input" value="<?php echo e($service->id); ?>">
                                                    <label class="custom-control-label" for="service-<?php echo e($service->id); ?>"><?php echo e($service->name); ?></label>
                                                </div>
                                            <?php else: ?>
                                                <div class="custom-control custom-checkbox">
                                                    <input id="service-<?php echo e($service->id); ?>" data-price="<?php echo e($service->price); ?>" data-title="<?php echo e($service->name); ?>" name="services[]" type="checkbox" class="custom-control-input service-checkbox" value="<?php echo e($service->id); ?>">
                                                    <label class="custom-control-label" for="service-<?php echo e($service->id); ?>"><?php echo e($service->name); ?></label> 
                                                </div>   
                                            <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
                                </div>
                                
                                
                                <div class="form-group row">
                                    <div class="offset-sm-2 col-sm-10">
                                        <button type="submit" class="btn btn-success">Update</button>
                                        <a class="btn btn-primary" href="<?php echo e(route('admin.users.index')); ?>">&nbsp;Back&nbsp;</a>
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

        $('.delete-user').on('submit', function(e){
            e.preventDefault();
            if ( confirm("Are you sure want to delete?") ) {
                this.submit();
            }
        });

        var datePickerOptions = {
            autoclose: true,
            orientation: "bottom auto",
            format: 'dd-mm-yyyy',
        };
        $('#input-dob').datepicker(datePickerOptions);
    });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home2/securtac/public_html/securtac/resources/views/admin/users/edit.blade.php ENDPATH**/ ?>