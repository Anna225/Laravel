<?php $__env->startSection('title'); ?>
    Add Schedule Slot
<?php $__env->stopSection(); ?>

<?php $__env->startSection('header_scripts'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('plugins/bootstrap-datepicker/bootstrap-datepicker3.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(URL::asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h4>Add Schedule Slot</h4>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?php echo e(route('admin.dashboard')); ?>">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?php echo e(route('admin.slots.index', $serviceId)); ?>">Schedule Slots</a></li>
                        <li class="breadcrumb-item active">Add Slot</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            
            <div class="row">
                <div class="col-md-8">
                    <div class="card card-info">
                        <!-- form start -->
                        <form class="form-horizontal" method="POST" action="<?php echo e(route('admin.slots.store', $serviceId)); ?>">
                            <?php echo csrf_field(); ?>
                            <div class="card-body">
                                <div class="form-group row">
                                    <label for="input-event" class="col-sm-2 col-form-label">Event</label>
                                    <div class="col-sm-10">
                                        <input name="event" type="text" class="form-control <?php if ($errors->has('question')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('question'); ?> is-invalid <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>" id="input-event" placeholder="Event Name" value="<?php echo e(old('event')); ?>" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="input-venue" class="col-sm-2 col-form-label">Venue</label>
                                    <div class="col-sm-10">
                                        <input name="venue" type="text" class="form-control <?php if ($errors->has('venue')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('venue'); ?> is-invalid <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>" id="input-venue" placeholder="Venue Name" value="<?php echo e(old('venue')); ?>" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="input-sdate" class="col-sm-2 col-form-label">Start Date</label>
                                    <div class="col-sm-10">
                                        <input name="start_date" type="text" class="datepicker form-control <?php if ($errors->has('start_date')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('start_date'); ?> is-invalid <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>" id="input-sdate" placeholder="Start Date" value="<?php echo e(old('start_date')); ?>" autocomplete="off" required>
                                        <?php if ($errors->has('start_date')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('start_date'); ?>
                                            <span class="invalid-feedback" role="alert">
                                                <strong><?php echo e($message); ?></strong>
                                            </span>
                                        <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="input-time" class="col-sm-2 col-form-label">Start Time</label>
                                    <div class="col-sm-10">
                                        <div class="date" id="input-time" data-target-input="nearest">
                                            <input type="text" name="start_time" class="form-control" placeholder="Select Time" data-target="#input-time" data-toggle="datetimepicker" autocomplete="off" required>
                                            <?php if ($errors->has('start_time')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('start_time'); ?>
                                                <span class="invalid-feedback" role="alert">
                                                    <strong><?php echo e($message); ?></strong>
                                                </span>
                                            <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="input-edate" class="col-sm-2 col-form-label">End Date</label>
                                    <div class="col-sm-10">
                                        <input name="end_date" type="text" class="datepicker form-control <?php if ($errors->has('end_date')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('end_date'); ?> is-invalid <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>" id="input-edate" placeholder="End Date" value="<?php echo e(old('end_date')); ?>" autocomplete="off" required>
                                        <?php if ($errors->has('end_date')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('end_date'); ?>
                                            <span class="invalid-feedback" role="alert">
                                                <strong><?php echo e($message); ?></strong>
                                            </span>
                                        <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="input-slots" class="col-sm-2 col-form-label">Total Slots</label>
                                    <div class="col-sm-10">
                                        <input name="total_slots" type="text" class="form-control <?php if ($errors->has('total_slots')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('total_slots'); ?> is-invalid <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>" id="input-slots" placeholder="Total Slots" value="<?php echo e(old('total_slots')); ?>" required>
                                        <?php if ($errors->has('total_slots')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('total_slots'); ?>
                                            <span class="invalid-feedback" role="alert">
                                                <strong><?php echo e($message); ?></strong>
                                            </span>
                                        <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>
                                    </div>
                                    
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-10">
                                        <input type="hidden" name="service_id" value="<?php echo e($serviceId); ?>">
                                        <input type="submit" name="submit" class="btn btn-info" value="Save" />
                                        <input type="submit" name="submit" class="btn btn-info" value="Save and Add another">
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
<script src="<?php echo e(URL::asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')); ?>"></script>
<script>
    $(document).ready(function(){
        var nowDate = new Date();
        var datePickerOptions = {
            startDate: nowDate,
            autoclose: true,
            orientation: "bottom auto",
            format: 'dd-mm-yyyy',
        };
        $('.datepicker').datepicker(datePickerOptions);

        $('#input-time').datetimepicker({
            format: 'LT'
        });

        <?php if($message = Session::get('success')): ?>
            toastr.success('<?php echo e($message); ?>')
        <?php endif; ?>

        <?php if($message = Session::get('error')): ?>
            toastr.error('<?php echo e($message); ?>')
        <?php endif; ?>
    });
    $(document).on('mouseup touchend', function (e) {
        var container = $('.bootstrap-datetimepicker-widget');
        if (!container.is(e.target) && container.has(e.target).length === 0) {
            container.parent().datetimepicker('hide');
        }
    });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home2/securtac/public_html/securtac/resources/views/admin/schedule-slots/create.blade.php ENDPATH**/ ?>