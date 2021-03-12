<?php $__env->startSection('header_scripts'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('plugins/bootstrap-datepicker/bootstrap-datepicker3.min.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="insite-content">

    <div class="my-courses">
        <div class="container pt-4">
            <div class="sec-title">
                <h1>My courses</h1>
            </div>
            <div class="table-responsive mt-4">
                <table class="table">
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $mySubscriptions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subscriptions): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr>
                                <td><?php echo e($subscriptions->service->name); ?> &nbsp; &nbsp; <span class="badge badge-success">Active</span></td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <div class="alert alert-warning" role="alert">
                                You have no active service subscription right now.
                            </div>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="my-consent-form">
        <div class="container pt-4">
            <div class="row mt-4">
                <div class="col-md-6 col-lg-6">
                    <div class="sec-title">
                        <h1>My Consent Form</h1>
                    </div>
                    <?php if(isset($user->consent_document)): ?>
                    <div class="p-3 mb-2 bg-light text-dark mt-3">
                        <a download href="<?php echo e(route('get.document', $user->consent_document->document )); ?>">My Consent Document</a> &nbsp; &nbsp; &nbsp; 
                        <?php if( $user->consent_document->status == 'approved' ): ?>
                            <span class="badge badge-success">Approved</span>
                        <?php elseif( $user->consent_document->status == 'pending' ): ?>
                            <span class="badge badge-secondary">Pending</span>
                        <?php else: ?>
                            <span class="badge badge-danger">Not Approved</span>
                        <?php endif; ?>
                    </div>
                    <?php endif; ?>            
                    <form action="<?php echo e(route('consent-document.upload')); ?>" method="POST" enctype="multipart/form-data">
                        <div class="row">
                            <div class="form-group col-md-6">
                                <div class="custom-file mt-3 input-group">
                                    <input type="file" name="consent_document" class="custom-file-input" id="logo">
                                    <label class="custom-file-label" for="image">Choose file</label>
                                </div>
                                <?php if ($errors->has('consent_document')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('consent_document'); ?>
                                    <span class="invalid-feedback d-block" role="alert">
                                        <strong><?php echo e($message); ?></strong>
                                    </span>
                                <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>
                            </div>
                            <div class="form-group col-md-6 mt-2">
                                <?php echo csrf_field(); ?>
                                <button class="btn btn-primary mb-3" type="submit">Upload</button>
                            </div>
                        </div>
                        
                    </form>
                </div>
                <div class="col-lg-1"></div>
                <div class="col-md-6 col-lg-5">
                    <div class="sec-title">
                        <h1>CPR Certificate</h1>
                    </div>
                    <?php if(isset($user->cpr_certificate)): ?>
                    <div class="p-3 mb-2 bg-light text-dark mt-3">
                        <a download href="<?php echo e(route('get.cpr_certificate', $user->cpr_certificate->document )); ?>">My CPR Certificate</a> &nbsp; &nbsp; &nbsp;
                        <a download class="" href="" title="Remove"><i class="fas fa-fw fa-remove"></i></a>
                    </div>
                    <?php endif; ?>
                    <form action="<?php echo e(route('cpr-certificate.upload')); ?>" method="POST" enctype="multipart/form-data">
                        <div class="row">
                            <div class="form-group col-md-6">
                                <div class="custom-file mt-3 input-group">
                                    <input type="file" name="cpr_certificate" class="custom-file-input" id="logo">
                                    <label class="custom-file-label" for="image">Choose file</label>
                                </div>
                                <?php if ($errors->has('cpr_certificate')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('cpr_certificate'); ?>
                                    <span class="invalid-feedback d-block" role="alert">
                                        <strong><?php echo e($message); ?></strong>
                                    </span>
                                <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>
                            </div>
                            <div class="form-group col-md-6 mt-2">
                                <?php echo csrf_field(); ?>
                                <button class="btn btn-primary mb-3" type="submit">Upload</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="site-part">
        <div class="container pb-5">
            
            <div class="row mt-4">
                <div class="col-md-6 col-lg-6">
                    <form action="<?php echo e(route('myaccount.action')); ?>" method="post">
                        <?php echo csrf_field(); ?>
                        <div class="sec-title mb-4">
                            <h1>My Account</h1>
                        </div>
                        <div class="row">
                            <div class="form-group col-12 col-sm-6">
                                <label>First Name</label>
                                <input type="text" name="first_name" class="form-control <?php if ($errors->has('first_name')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('first_name'); ?> is-invalid <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>" placeholder="First Name" value="<?php echo e($user->first_name); ?>" required>
                                <?php if ($errors->has('first_name')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('first_name'); ?>
                                <span class="invalid-feedback" role="alert">
                                    <strong><?php echo e($message); ?></strong>
                                </span>
                                <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>
                            </div>

                            <div class="form-group col-12 col-sm-6">
                                <label>Last Name</label>
                                <input type="text" name="last_name" class="form-control <?php if ($errors->has('last_name')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('last_name'); ?> is-invalid <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>" placeholder="Last Name" value="<?php echo e($user->last_name); ?>" required>
                                <?php if ($errors->has('last_name')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('last_name'); ?>
                                <span class="invalid-feedback" role="alert">
                                    <strong><?php echo e($message); ?></strong>
                                </span>
                                <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>
                            </div>

                            <div class="form-group col-12">
                                <label>Email Address</label>
                                <input type="email" name="email" class="form-control <?php if ($errors->has('email')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('email'); ?> is-invalid <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>" placeholder="Email Address" value="<?php echo e($user->email); ?>" required>
                                
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

                            <div class="form-group col-12">
                                <label>Phone Number</label>
                            <input type="tel" name="mobile_number" class="form-control <?php if ($errors->has('mobile_number')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('mobile_number'); ?> is-invalid <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>" placeholder="Phone Number" value="<?php echo e($user->mobile_number); ?>" required>

                                <?php if ($errors->has('mobile_number')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('mobile_number'); ?>
                                <span class="invalid-feedback" role="alert">
                                    <strong><?php echo e($message); ?></strong>
                                </span>
                                <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>
                            </div>

                            <div class="form-group col-12">
                                <label>Date of Birth</label>
                                <input type="text" name="birth_date" id="birth_date" class="form-control <?php if ($errors->has('birth_date')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('birth_date'); ?> is-invalid <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>" placeholder="DD/MM/YYYY" value="<?php echo e(date("d-m-Y", strtotime($user->birth_date))); ?>" required>

                                <?php if ($errors->has('birth_date')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('birth_date'); ?>
                                <span class="invalid-feedback" role="alert">
                                    <strong><?php echo e($message); ?></strong>
                                </span>
                                <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>
                            </div>

                            <div class="form-group col-12">
                                <label>Street Number & Street Name</label>
                                <input type="text" name="addres_line_1" class="form-control <?php if ($errors->has('address_line_1')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('address_line_1'); ?> is-invalid <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>" placeholder="Street Number & Street Name" value="<?php echo e($user->address_line_1); ?>">

                                <?php if ($errors->has('address_line_1')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('address_line_1'); ?>
                                <span class="invalid-feedback" role="alert">
                                    <strong><?php echo e($message); ?></strong>
                                </span>
                                <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>
                            </div>

                            <div class="form-group col-12">
                                <label>Apartment/Unit Number</label>
                                <input type="text" name="address_line_2" class="form-control <?php if ($errors->has('address_line_2')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('address_line_2'); ?> is-invalid <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>" placeholder="Apartment/Unit Number" value="<?php echo e($user->address_line_2); ?>">
                            
                                <?php if ($errors->has('address_line_2')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('address_line_2'); ?>
                                <span class="invalid-feedback" role="alert">
                                    <strong><?php echo e($message); ?></strong>
                                </span>
                                <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>
                            </div>

                            <div class="form-group col-12 col-sm-6">
                                <label>City</label>
                                <input type="text" name="city" class="form-control <?php if ($errors->has('city')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('city'); ?> is-invalid <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>" placeholder="City" value="<?php echo e($user->city); ?>" required>
                                
                                <?php if ($errors->has('city')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('city'); ?>
                                <span class="invalid-feedback" role="alert">
                                    <strong><?php echo e($message); ?></strong>
                                </span>
                                <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>    
                            </div>

                            <div class="form-group col-12 col-sm-6">
                                <label>Province/State</label>
                                <input type="text" name="state" class="form-control <?php if ($errors->has('state')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('state'); ?> is-invalid <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>" placeholder="Province/State" value="<?php echo e($user->state); ?>" required>
                            
                                <?php if ($errors->has('state')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('state'); ?>
                                <span class="invalid-feedback" role="alert">
                                    <strong><?php echo e($message); ?></strong>
                                </span>
                                <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>    
                            </div>

                            <div class="form-group col-12 col-sm-6">
                                <label>Postal Code</label>
                                <input type="text" name="postal_code" class="form-control <?php if ($errors->has('postal_code')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('postal_code'); ?> is-invalid <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>" placeholder="Postal Code" value="<?php echo e($user->postal_code); ?>" required>
                            
                                <?php if ($errors->has('postal_code')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('postal_code'); ?>
                                <span class="invalid-feedback" role="alert">
                                    <strong><?php echo e($message); ?></strong>
                                </span>
                                <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>    
                            </div>

                            <div class="form-group col-12 col-sm-6">
                                <label>Country</label>
                                <input type="text" name="country" class="form-control <?php if ($errors->has('country')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('country'); ?> is-invalid <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>" placeholder="Country" value="<?php echo e($user->country); ?>" required>
                            
                                <?php if ($errors->has('country')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('country'); ?>
                                <span class="invalid-feedback" role="alert">
                                    <strong><?php echo e($message); ?></strong>
                                </span>
                                <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>
                            </div>
                        </div>
                        <div class="mt-30">
                            <button class="btn btn-primary mb-3" type="submit">Update</button>
                        </div>
                    </form>
                </div>
                <div class="col-lg-1"></div>
                <div class="col-md-6 col-lg-5">
                    <div class="sec-title mb-4">
                        <h1>Change Password</h1>
                    </div>
                    <form action="<?php echo e(route('change-password')); ?>" method="post" id="password-form">
                        <?php echo csrf_field(); ?>
                        <div class="row">
                            <div class="form-group col-12">
                                <label>Current Password</label>
                                <input type="password"  name="current_password" id="current-password" class="form-control <?php if ($errors->has('current_password')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('current_password'); ?> is-invalid <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>" placeholder="Enter Current Password">

                                <?php if ($errors->has('current_password')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('current_password'); ?>
                                <span class="invalid-feedback" role="alert">
                                    <strong><?php echo e($message); ?></strong>
                                </span>
                                <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>
                            </div>

                            <div class="form-group col-12">
                                <label>New Password</label>
                                <input type="password" name="password" id="password" class="form-control <?php if ($errors->has('password')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('password'); ?> is-invalid <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>" placeholder="Enter New Password">

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

                            <div class="form-group col-12">
                                <label>Confirm New Password</label>
                                <input type="password" name="password_confirmation" class="form-control" id="password-confirm" placeholder="Enter Confirm New Password">
                            </div>
                        </div>
                        <div class="mt-30">
                            <button class="btn btn-primary mb-3" type="submit">Change Password</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer_scripts'); ?>
<script src="<?php echo e(URL::asset('plugins/moment/moment.min.js')); ?>"></script>
<script src="<?php echo e(URL::asset('plugins/bootstrap-datepicker/bootstrap-datepicker.min.js')); ?>"></script>
<script>
    $(document).ready(function(){
        <?php if($message = Session::get('success')): ?>
            toastr.success('<?php echo e($message); ?>')
        <?php endif; ?>

        <?php if($message = Session::get('error')): ?>
            toastr.error('<?php echo e($message); ?>')
        <?php endif; ?>

        $('#birth_date').datepicker({});

    });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home2/securtac/public_html/securtac/resources/views/myaccount.blade.php ENDPATH**/ ?>