<?php $__env->startSection('header_scripts'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="insite-content main-content">

    <div class="bread-top">
        <div class="container">
            <h3>Welcome <?php echo e(auth()->user()->name); ?>,</h3>
        </div>
    </div>

    <div class="site-part">
        <div class="container">
            <div>
                <div class="sec-title">
                    <h1>Services</h1>
                </div>
                <div class="row mt-4">
                    <?php $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col-md-4 reveal">
                            <div class="service-plate">
                                <div class="service-top">
                                    <img src="<?php echo e($service->image_url); ?>" width="100%">
                                </div>
                                <div class="service-desc">
                                    <h3><?php echo e($service->name); ?></h3>

                                    <?php if( $key == 0 ): ?>
                                        <?php if( ! isSubscribed( $service->id ) ): ?>
                                            <h4 class="inside-cost">$<?php echo e($service->price_without_tax); ?></h4>
                                            <div class="text-center">
                                                <a href="<?php echo e(route('subscribe', $service->id )); ?>">
                                                    <button class="btn btn-primary no-mw"> Enroll Now
                                                        <i class="icon-arrow-right ml-2"></i>
                                                    </button>
                                                </a>
                                            </div>
                                        <?php elseif( isSubscribed( $service->id )->status == 'subscribed' ): ?>
                                            <h4 class="inside-cost">&nbsp;</h4>
                                            <div class="text-center">
                                                <a href="<?php echo e(route("training_chapters")); ?>">
                                                    <button class="btn btn-primary no-mw"> Study Now
                                                        <i class="icon-arrow-right ml-2"></i>
                                                    </button>
                                                </a>
                                            </div>
                                        <?php else: ?>
                                            <h4 class="inside-cost">$<?php echo e($service->price_without_tax); ?></h4>
                                            <div class="text-center">
                                                <a href="<?php echo e(route('subscribe', $service->id )); ?>">
                                                    <button class="btn btn-primary no-mw"> Renew Now
                                                        <i class="icon-arrow-right ml-2"></i>
                                                    </button>
                                                </a>
                                            </div>
                                        <?php endif; ?>

                                    <?php elseif( $key == 1 ): ?>
                                        <?php if( ! isSubscribed( $service->id ) ): ?>
                                            <h4 class="inside-cost">$<?php echo e($service->price_without_tax); ?></h4>
                                            <div class="text-center">
                                                <a href="<?php echo e(route('subscribe', $service->id )); ?>">
                                                    <button class="btn btn-primary no-mw"> Enroll Now
                                                        <i class="icon-arrow-right ml-2"></i>
                                                    </button>
                                                </a>
                                            </div>
                                        <?php elseif( isSubscribed( $service->id )->status == 'subscribed' ): ?>
                                            <h4 class="inside-cost">&nbsp;</h4>
                                            <div class="text-center">
                                                <a href="<?php echo e(route("schedule", $service->id)); ?>">
                                                    <button class="btn btn-primary no-mw"> Schedule
                                                        <i class="icon-arrow-right ml-2"></i>
                                                    </button>
                                                </a>
                                            </div>
                                        <?php else: ?>
                                            <h4 class="inside-cost">$<?php echo e($service->price_without_tax); ?></h4>
                                            <div class="text-center">
                                                <a href="<?php echo e(route('subscribe', $service->id )); ?>">
                                                    <button class="btn btn-primary no-mw"> Renew Now
                                                        <i class="icon-arrow-right ml-2"></i>
                                                    </button>
                                                </a>
                                            </div>
                                        <?php endif; ?>

                                    <?php elseif( $key == 2 ): ?>
                                        <?php if( ! isSubscribed( $service->id ) ): ?>
                                            <h4 class="inside-cost">$<?php echo e($service->price_without_tax); ?></h4>
                                            <div class="text-center">
                                                <a href="<?php echo e(route('subscribe', $service->id )); ?>">
                                                    <button class="btn btn-primary no-mw"> Enroll Now
                                                        <i class="icon-arrow-right ml-2"></i>
                                                    </button>
                                                </a>
                                            </div>
                                        <?php elseif( isSubscribed( $service->id )->status == 'subscribed' ): ?>
                                            <h4 class="inside-cost">&nbsp;</h4>
                                            <div class="text-center">
                                                <a href="<?php echo e(route("schedule", $service->id)); ?>">
                                                    <button class="btn btn-primary no-mw"> Schedule
                                                        <i class="icon-arrow-right ml-2"></i>
                                                    </button>
                                                </a>
                                            </div>
                                        <?php else: ?>
                                            <h4 class="inside-cost">$<?php echo e($service->price_without_tax); ?></h4>
                                            <div class="text-center">
                                                <a href="<?php echo e(route('subscribe', $service->id )); ?>">
                                                    <button class="btn btn-primary no-mw"> Renew Now
                                                        <i class="icon-arrow-right ml-2"></i>
                                                    </button>
                                                </a>
                                            </div>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>

            <div class="tra-process">
                <div class="sec-title">
                    <h1>Security Training Progress</h1>
                </div>

                <div class="table-responsive mt-4">
                    
                    <?php if( ! $securitySubscription ): ?>
                        <div class="alert alert-info" role="alert">
                            Please enroll to Security Training Syllabus service
                        </div>
                    <?php elseif( $securitySubscription->status == 'expired' ): ?>
                        <div class="alert alert-info" role="alert">
                            <h3 class="alert-heading">Expired</h3>
                            <p>Your service has been expired.Please renew your subscription in order to view the progress.</p>
                        </div>
                    <?php else: ?>
                        <table class="table">
                            <tbody>
                                <?php $__currentLoopData = $trainingChapters; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $chapter): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td class="max-wtd"><?php echo e(($key + 1).'. '.$chapter->name); ?></td>

                                        <?php if( ! $chapter->quiz_reports->isEmpty() ): ?>
                                            <td class="disflexc">
                                                <div class="progress cus-progress">
                                                    <div class="progress-bar" style="width:<?php echo e($chapter->quiz_reports->first()->percentage); ?>%"></div>
                                                </div>
                                                <?php echo e($chapter->quiz_reports->last()->percentage); ?>%
                                            </td>
                                            <td class="mw-td"><b><?php echo e($chapter->quiz_reports->last()->total_correct); ?></b>/ <?php echo e($chapter->quiz_reports->last()->total_questions); ?></td>
                                            <td class="text-center">
                                                <a href="<?php echo e(route('show_slides', $chapter->id)); ?>"><button class="btn btn-outline-danger btn-small">Study Now</button></a>
                                                &nbsp;
                                                <button class="btn btn-outline-primary btn-small" disabled><?php echo e(ucfirst($chapter->quiz_reports->last()->result_status)); ?></button>
                                                &nbsp;
                                                <?php if( $chapter->quiz_reports->last()->result_status == 'failed' ): ?>
                                                    <a href="<?php echo e(route('quiz', $chapter->id)); ?>"><button class="btn btn-outline-danger btn-small">Take Quiz</button></a>
                                                <?php elseif( $chapter->quiz_reports->last()->result_status == 'passed' ): ?>
                                                    <a href="<?php echo e(route('quiz', $chapter->id)); ?>"><button class="btn btn-outline-danger btn-small">Result</button></a>
                                                <?php endif; ?>
                                            </td>
                                        <?php elseif( ! $chapter->study_log->isEmpty() ): ?>
                                            <?php if( $chapter->study_log->first()->is_finished ): ?>
                                                <td class="disflexc">
                                                    <div class="progress cus-progress">
                                                        <div class="progress-bar bg-danger" style="width:100%"></div>
                                                    </div>
                                                    100%
                                                </td>
                                                <td class="mw-td"><b>0</b>/0</td>
                                                <td class="text-center">
                                                    <a href="<?php echo e(route('show_slides', $chapter->id)); ?>"><button class="btn btn-outline-danger btn-small">Study Now</button></a>
                                                    &nbsp;
                                                    <a href="<?php echo e(route('quiz', $chapter->id)); ?>"><button class="btn btn-outline-danger btn-small">Take Quiz</button></a>
                                                </td>
                                            <?php elseif( isStudyAllowed( $chapter->id ) ): ?>
                                                <td class="disflexc">
                                                    <div class="progress cus-progress">
                                                        <div class="progress-bar bg-danger" style="width:<?php echo e($chapter->study_log->first()->percentage); ?>%"></div>
                                                    </div>
                                                    <?php echo e($chapter->study_log->first()->percentage); ?>%
                                                </td>
                                                <td class="mw-td"><b>0</b>/0</td>
                                                <td class="text-center">
                                                    <a href="<?php echo e(route('show_slides', $chapter->id)); ?>"><button class="btn btn-outline-danger btn-small">Study Now</button></a>
                                                </td>
                                            <?php endif; ?>
                                        <?php else: ?>
                                            <td class="disflexc">
                                                <div class="progress cus-progress">
                                                    <div class="progress-bar" style="width:0%"></div>
                                                </div>
                                                0%
                                            </td>
                                            <td class="mw-td"><b>0</b>/0</td>
                                            <?php if( isStudyAllowed( $chapter->id ) ): ?>
                                                <td class="text-center">
                                                    <a href="<?php echo e(route('show_slides', $chapter->id)); ?>"><button class="btn btn-outline-danger btn-small last">Study Now</button></a>
                                                </td>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php if( ! $user->final_quiz->isEmpty() ): ?>
                                    <tr>
                                        <td><h5><strong>Final Quiz</strong></h5></td>
                                        <td class="disflexc">
                                            <div class="progress cus-progress">
                                                <div class="progress-bar" style="width:<?php echo e($user->final_quiz->last()->percentage); ?>%"></div>
                                            </div>
                                            <?php echo e($user->final_quiz->last()->percentage); ?>%
                                            <td class="mw-td"><b><?php echo e($user->final_quiz->last()->total_correct); ?></b>/ <?php echo e($user->final_quiz->last()->total_questions); ?></td>
                                            <td class="text-center">
                                                <button class="btn btn-outline-primary btn-small" disabled><?php echo e(ucfirst($user->final_quiz->last()->result_status)); ?></button>
                                                &nbsp;
                                                <?php if( $user->final_quiz->last()->result_status == 'failed' ): ?>
                                                    <a href="<?php echo e(route('quiz', 'final')); ?>"><button style="width: 62%;" class="btn btn-outline-danger btn-small">Take Final Quiz</button></a>
                                                <?php elseif( $user->final_quiz->last()->result_status == 'passed' ): ?>
                                                    <a href="<?php echo e(route('quiz', 'final')); ?>"><button style="width: 62%;" class="btn btn-outline-danger btn-small">View Result</button></a>
                                                <?php endif; ?>
                                            </td>
                                        </td>
                                    </tr>
                                <?php elseif( isFinalQuizAllowed() ): ?>
                                    <tr>
                                        <td><h5><strong>Final Quiz</strong></h5></td>
                                        <td class="disflexc">
                                            <div class="progress cus-progress">
                                                <div class="progress-bar" style="width: 0%"></div>
                                            </div>
                                            0%
                                            <td class="mw-td"> - </td>
                                            <td class="text-center">
                                                <a href="<?php echo e(route('quiz', 'final')); ?>"><button style="width: 62%;" class="btn btn-outline-danger btn-small">Take Final Quiz</button></a>
                                            </td>
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    <?php endif; ?>
                </div>
            </div>

            <?php echo $__env->make('partials.referral_block', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>
    </div>

</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer_scripts'); ?>
<script>
    $(document).ready(function(){
        <?php if( ! $user->consent_document ): ?>
            var notification = $('#siteNoticeBar').notificationBanner({
                text: 'Please submit consent document on my account page.&nbsp; &nbsp; &nbsp;<a href="<?php echo e(asset(getMetaValue("consent_form"))); ?>" download><button type="button" class="btn btn-small btn-primary">Download</button></a>',
                //position:"top",
                height:"50px",
                padding:"10px",
                width:"100%"
            });
        <?php endif; ?>
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home2/securtac/public_html/securtac/resources/views/dashboard.blade.php ENDPATH**/ ?>