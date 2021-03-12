<?php $__env->startSection('title'); ?>
    Users
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <a href="<?php echo e(route('admin.users.index')); ?>">Back</a>
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
            <div class="row">
                <div class="col-md-3">
                    <!-- Profile Image -->
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile text-center">
                            <div class="">
                                <img class="profile-user-img img-fluid img-circle" src="<?php echo e($user->avatar_url); ?>"
                                alt="User profile picture">
                            </div>
            
                            <h3 class="profile-username"><?php echo e($user->name); ?></h3>
                            <?php if( $user->status == '1' ): ?>
                                <h5><span class="badge badge-success">Active</span></h4>
                            <?php else: ?>
                                <h5><span class="badge badge-danger">Deactive</span></h4>
                            <?php endif; ?>
                            <hr />
                            <p class="text-muted" title="Email Address"><i class="fas fa-envelope"></i> &nbsp;<?php echo e($user->email); ?></p>
                            <hr />
                            <p class="text-muted" title="Phone Number"><i class="fas fa-phone"></i> &nbsp;<?php echo e($user->mobile_number); ?></p>
                            <hr />
                            <p class="text-muted" title="Birth Date"><i class="fas fa-birthday-cake"></i> &nbsp;<?php echo e(date('d-m-Y', strtotime($user->birth_date))); ?></p>
                            <hr />
                            <p class="text-muted" title="Referral Code"><i class="fas fa-users"></i> &nbsp;<?php echo e($user->referral_code); ?></p>
                            <a href="<?php echo e(route('admin.users.edit',$user->id)); ?>" class="btn btn-primary btn-block">Edit</a>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->

                    <div class="card card-secondary">
                        <div class="card-header">
                            <h3 class="card-title">Address Details</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <strong><i class="fas fa-map-marker-alt mr-1"></i> Address</strong>
                    
                            <p class="text-muted">
                                <?php echo e($user->address_line_1 ?? ''); ?>&nbsp;<?php echo e($user->address_line_2 ?? ''); ?>

                            </p>
                            <strong>Postal Code</strong>
                            <p class="text-muted"><?php echo e($user->postal_code ?? '-'); ?></p>
                            <hr>
                    
                            <strong><i class="fas fa-map-marker-alt mr-1"></i> City</strong>
                    
                            <p class="text-muted"><?php echo e($user->city ?? '-'); ?></p>
                    
                            <hr>
                            <strong><i class="fas fa-map-marker-alt mr-1"></i> State</strong>
                            <p class="text-muted"> <?php echo e($user->state ?? '-'); ?> </p>
                    
                            <hr>
                            <strong><i class="fas fa-map-marker-alt mr-1"></i> Country</strong>
                            <p class="text-muted"><?php echo e($user->country ?? '-'); ?></p>                            
                        </div>
                        <!-- /.card-body -->
                    </div>

                    <div class="card card-secondary">
                        <div class="card-header">
                            <h3 class="card-title">Documents</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <?php if(isset($user->consent_document)): ?>
                                <strong><i class="fas fa-file-alt mr-1"></i>Consent Document</strong>

                                <p class="text-muted">
                                    <a target="_blank" href="<?php echo e(route('get.document', $user->consent_document->document )); ?>">Consent Document</a>
                                </p>
                            <?php endif; ?>

                            <?php if(isset($user->cpr_document)): ?>
                                <strong><i class="fas fa-file-alt mr-1"></i>CPR Certificate</strong>

                                <p class="text-muted">
                                    <a target="_blank" href="<?php echo e(route('get.document', $user->cpr_document->document )); ?>">CPR Certificate</a>
                                </p>
                            <?php endif; ?>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
                <div class="col-md-9">
                <div class="card card-dark">
                        <div class="card-header">
                            <h3 class="card-title">Invite List</h3>
                            <div class="card-tools">
                                <button type="button" class="btn bg-white btn-sm" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <!-- /.row -->
                            <div class="row">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Email</th>
                                            <th>Is Registered</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $__empty_1 = true; $__currentLoopData = $user->invites; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $invite): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                            <tr>
                                                <td><?php echo e($key+1); ?></td>
                                                <td><?php echo e($invite->invite_email); ?></td>
                                                <td><?php if($invite->is_registered): ?> Yes <?php else: ?> No <?php endif; ?></td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                        <tr>
                                            <td colspan="6" class="text-center">User has not invited any other users yet.</td>
                                        </tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div><!-- /.card-body -->
                    </div>
                    <div class="card card-dark">
                        <div class="card-header">
                            <h3 class="card-title">Services</h3>
                            <div class="card-tools">
                                <button type="button" class="btn bg-white btn-sm" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <!-- /.row -->
                            <div class="row">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Service</th>
                                            <th>Subscription Date</th>
                                            <th>Expiry Date</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $__empty_1 = true; $__currentLoopData = $user->subscriptions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $subscription): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                            <tr>
                                                <td><?php echo e($key+1); ?></td>
                                                <td><?php echo e($subscription->service_name); ?></td>
                                                <td><?php echo e(date('d-m-Y', strtotime($subscription->created_at))); ?></td>
                                                <td><?php echo e(date('d-m-Y', strtotime($subscription->ends_at))); ?></td>
                                                <td>
                                                    <?php if( $subscription->status == 'subscribed' ): ?>
                                                        <h5><span class="badge badge-success">Active</span></h4>
                                                    <?php else: ?>
                                                        <h5><span class="badge badge-danger">Expired</span></h4>
                                                    <?php endif; ?>
                                                </td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                        <tr>
                                            <td colspan="6" class="text-center">There are no services purchased by user.</td>
                                        </tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div><!-- /.card-body -->
                    </div>
                    <!-- /.nav-tabs-custom -->

                    <div class="card card-dark">
                        <div class="card-header">
                            <h3 class="card-title">Security Training Progress</h3>
                            <div class="card-tools">
                                <button type="button" class="btn bg-white btn-sm" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-responsive">
                                <thead>
                                    <tr>
                                        <th style="width: 0.5%">
                                            #
                                        </th>
                                        <th style="width: 38%">
                                            Chapter
                                        </th>
                                        <th style="width: 32%">
                                            Progress
                                        </th>
                                        <th style="width: 15%">
                                            Status
                                        </th>
                                        <th>
                                            Time
                                        </th>
                                    </tr>
                                </thead>
                                <?php $__currentLoopData = $trainingChapters; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $chapter): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e(($key + 1)); ?></td>
                                        <td><?php echo e($chapter->name); ?></td>
                                        <?php if( ! $chapter->study_log->isEmpty() ): ?>
                                            <?php if( $chapter->study_log->first()->is_finished ): ?>
                                                <td class="disflexc">
                                                    <div class="progress cus-progress">
                                                        <div class="progress-bar bg-danger" style="width:100%"></div>
                                                    </div>
                                                    100%
                                                </td>
                                                <td>
                                                    Completed
                                                </td>
                                                <td class="result_time_spent" data-sec="<?php echo e($chapter->study_log->first()->time_spent); ?>"><?php echo e($chapter->study_log->first()->time_spent ?? ''); ?></td>
                                            <?php else: ?>
                                                <td class="disflexc">
                                                    <div class="progress cus-progress">
                                                        <div class="progress-bar bg-danger" style="width:<?php echo e($chapter->study_log->first()->percentage); ?>%"></div>
                                                    </div>
                                                    <?php echo e($chapter->study_log->first()->percentage); ?>%
                                                </td>
                                                <td> In Progress </td>
                                                <td class="result_time_spent" data-sec="<?php echo e($chapter->study_log->first()->time_spent); ?>"><?php echo e($chapter->study_log->first()->time_spent ?? ''); ?></td>
                                            <?php endif; ?>
                                        <?php else: ?>
                                            <td class="disflexc">
                                                <div class="progress cus-progress">
                                                    <div class="progress-bar" style="width:0%"></div>
                                                </div>
                                                0%
                                            </td>
                                            <td>-</td>
                                            <td class=""> - </td>
                                        <?php endif; ?>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </table>                    
                        </div>
                        <!-- /.card-body -->
                    </div>

                    <div class="card card-dark">
                        <div class="card-header">
                            <h3 class="card-title">Quiz Report</h3>
                            <div class="card-tools">
                                <button type="button" class="btn bg-white btn-sm" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-responsive">
                                <thead>
                                    <tr>
                                        <th style="width: 1%">
                                            #
                                        </th>
                                        <th style="width: 55%">
                                            Chapter
                                        </th>
                                        <th style="width: 15%">
                                            Percentage
                                        </th>
                                        <th>
                                            Marks
                                        </th>
                                        <th>
                                            Result
                                        </th>
                                    </tr>
                                </thead>
                                <?php $__currentLoopData = $trainingChapters; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $chapter): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e(($key + 1)); ?></td>
                                        <td><?php echo e($chapter->name); ?></td>
                                        <?php if( ! $chapter->quiz_reports->isEmpty() ): ?>
                                            <td class="disflexc">
                                                <?php echo e($chapter->quiz_reports->last()->percentage); ?>%
                                            </td>
                                            <td class="mw-td"><b><?php echo e($chapter->quiz_reports->last()->total_correct); ?></b>/ <?php echo e($chapter->quiz_reports->last()->total_questions); ?></td>
                                            <td><?php echo e(ucfirst( $chapter->quiz_reports->last()->result_status )); ?></td>
                                        <?php else: ?>
                                            <td class="disflexc">
                                                -
                                            </td>
                                            <td class="mw-td"><b>-</td>
                                            <td>Not Taken</td>
                                        <?php endif; ?>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td colspan="5"></td>
                                </tr>
                                <?php if( ! $user->final_quiz->isEmpty() ): ?>
                                    <tr class="table-primary">
                                        <td>##</td>
                                        <td><strong>Final Quiz</strong></td>
                                        <td class="disflexc">
                                            <?php echo e($user->final_quiz->last()->percentage); ?>%
                                        </td>
                                        <td class="mw-td"><b><?php echo e($user->final_quiz->last()->total_correct); ?></b>/ <?php echo e($user->final_quiz->last()->total_questions); ?></td>
                                        <td><?php echo e(ucfirst( $user->final_quiz->last()->result_status )); ?></td>
                                    </tr>
                                <?php endif; ?>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer_scripts'); ?>
<script src="<?php echo e(asset('js/main.js')); ?>"></script>
<script>
    $(document).ready(function(){
        $('.result_time_spent').each(function(i, time){
            console.log(time);
            var time = $(this).attr('data-sec');
            $(this).text( ' '+secondsToPrettyTime(time) );
        });
        <?php if($message = Session::get('success')): ?>
            toastr.success('<?php echo e($message); ?>')
        <?php endif; ?>

        <?php if($message = Session::get('error')): ?>
            toastr.error('<?php echo e($message); ?>')
        <?php endif; ?>
    });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home2/securtac/public_html/securtac/resources/views/admin/users/show.blade.php ENDPATH**/ ?>