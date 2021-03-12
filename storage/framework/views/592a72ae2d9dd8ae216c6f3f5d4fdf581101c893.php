<?php $__env->startSection('title'); ?>
    Schedule Slot Details
<?php $__env->stopSection(); ?>

<?php $__env->startSection('header_scripts'); ?>        
    <link rel="stylesheet" href="<?php echo e(URL::asset('plugins/sweetalert2/sweetalert2.min.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <a href="<?php echo e(route('admin.slots.index', $scheduleSlot->service_id)); ?>">Back</a>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?php echo e(route('admin.dashboard')); ?>">Home</a></li>
                        <li class="breadcrumb-item active"><a href="<?php echo e(route('admin.slots.index', $scheduleSlot->service_id)); ?>">Schedule Slots</a></li>
                        <li class="breadcrumb-item active">View</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div style="margin-bottom: 10px;" class="row">
                <div class="col-lg-12">
                    <a class="btn btn-primary pull-right" href="<?php echo e(route('admin.slots.edit', $scheduleSlot->id)); ?>">
                        Edit Slot
                    </a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-7">
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <th>Service </th>
                                <td>
                                    <?php echo e($scheduleSlot->service->name); ?>

                                </td>
                            </tr>
                            <tr>
                                <th>Event </th>
                                <td>
                                    <?php echo e($scheduleSlot->event); ?>

                                </td>
                            </tr>
                            <tr>
                                <th>Venue </th>
                                <td>
                                    <?php echo e($scheduleSlot->venue); ?>

                                </td>
                            </tr>
                            <tr>
                                <th>Start Date </th>
                                <td>
                                    <?php echo e($scheduleSlot->start_date); ?>

                                </td>
                            </tr>
                            <tr>
                                <th>Start Time </th>
                                <td>
                                    <?php echo e($scheduleSlot->start_time); ?>

                                </td>
                            </tr>
                            <tr>
                                <th>End Date </th>
                                <td>
                                    <?php echo e($scheduleSlot->end_date); ?>

                                </td>
                            </tr>
                            <tr>
                                <th>Status </th>
                                <td>
                                    <?php echo e($scheduleSlot->status); ?>

                                </td>
                            </tr>
                            <tr>
                                <th></th>
                                <td colspan="2">
                                    <a href="#" data-slot="<?php echo e($scheduleSlot->id); ?>" class="btn btn-success btn-sm add-users">Add Users</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- /.row -->
            <div class="row">
                <h4><strong>Users </strong></h4>
                <div class="col-md-12">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>User</th>
                                <th>User Email</th>
                                <th>User Mobile Number</th>
                                <th>Booking Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__empty_1 = true; $__currentLoopData = $scheduleSlot->user_schedules; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $schedule): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr>
                                    <td><?php echo e($key+1); ?></td>
                                    <td><a href="<?php echo e(route('admin.users.show', $schedule->user->id)); ?>"><?php echo e($schedule->user->name); ?></td>
                                    <td><?php echo e($schedule->user->email); ?></td>
                                    <td><?php echo e($schedule->user->mobile_number); ?></td>
                                    <td><?php echo e(date('d-m-Y', strtotime($schedule->created_at))); ?></td>
                                    <td>
                                        <a href="#" class="delete-slot btn btn-danger btn-sm" title="Delete Slot"><i class="fa-fw fas fa-trash"></i>Delete</a>
                                        <form class="delete-form" action="<?php echo e(route('admin.delete.appointment', $schedule->id)); ?>" method="POST" style="display: inline-block;">
                                            <?php echo method_field('DELETE'); ?>
                                            <?php echo csrf_field(); ?>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="6" class="text-center">There are no users booked with this schedule slot.</td>
                            </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer_scripts'); ?>
<script src="<?php echo e(asset('plugins/sweetalert2/sweetalert2.all.min.js')); ?>"></script>
<script>
    $(document).ready(function(){
        $('.delete-slot').on('click', function(e){
            e.preventDefault();
            if ( confirm("Are you sure want to delete?") ) {
                $(this).next().submit();
            }
        });

        $('.add-users').click(function(e){
            e.preventDefault();
            var slot_id = $(this).attr('data-slot');

            Swal.fire({
                title: 'Enter email address',
                inputPlaceholder: 'Email address',
                input: 'email',
                showCancelButton: true,
                confirmButtonText: 'Send',
                showLoaderOnConfirm: true,
                inputAutoTrim: false,
                inputValidator: (value) => {
                    if (!value) {
                        return 'Please enter valid email address'
                    }
                },
                preConfirm: (email) => {
                    var headers = {
                        "Content-Type": "application/json",                                                                                                
                        "Access-Control-Origin": "*",
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                    return fetch(`<?php echo e(route('admin.schedule.addUser')); ?>`,{
                        method: "POST",
                        headers: headers,
                        body:  JSON.stringify({ email: `${email}`, slot_id: slot_id })
                    })
                    .then(response => {
                        console.log(response);
                        if (!response.ok) {
                            throw new Error(response.statusText)
                        }
                        return response.json()
                    })
                    .catch(error => {
                        Swal.showValidationMessage(
                        `Request failed: ${error}`
                        )
                    })
                },
                allowOutsideClick: () => !Swal.isLoading()
            }).then((result) => {
                if (result.value.status == 'success') {
                    Swal.fire({
                        type: 'success',
                        title: 'Success',
                        text: result.value.msg,
                    }).then((result) => {
                        window.location.reload();
                    });
                } else {
                    Swal.fire({
                        type: 'error',
                        title: 'Error',
                        text: result.value.msg,
                    }).then((result) => {
                        window.location.reload();
                    });
                }
            })
        });
    });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home2/securtac/public_html/securtac/resources/views/admin/schedule-slots/show.blade.php ENDPATH**/ ?>