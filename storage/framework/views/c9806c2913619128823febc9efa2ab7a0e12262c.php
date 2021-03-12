<?php $__env->startSection('content'); ?>
<div class="insite-content">

    <div class="site-part schedule-page">
        <div class="container">
            <div class="sec-title">
                <h1>Security Training Chapters</h1>
            </div>

            <div class="mt-30">
                <div class="row">
                    <?php $__currentLoopData = $trainingChapters; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $chapter): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col-sm-6 col-lg-4">
                            <div class="chapter-card">
                                <?php if( ! isStudyAllowed( $chapter->id ) && ! isQuizAllowed( $chapter->id ) ): ?>
                                    <div class="chapter-lock">
                                        <h1 class="ic-lock"><i class="icon-padlock"></i></h1>
                                    </div>
                                <?php endif; ?>
                                <div class="row">
                                    <div class="col-6 left-cover">
                                        <img src="<?php echo e($chapter->image_url); ?>" width="100%">
                                        <h4>Chapter <?php echo e($key+1); ?></h4>
                                    </div>
                                    <div class="col-6 right-cover">
                                        <h6 class="fw-700 mb-3"><?php echo e($chapter->name); ?></h6>

                                        <?php if( $chapter->slides_count > 0 && isStudyAllowed( $chapter->id ) ): ?>
                                            <a href="<?php echo e(route('show_slides', $chapter->id )); ?>">
                                                <button class="btn btn-outline-dark mw130 mb-3" type="submit">Tutorial
                                                    <i class="icon-arrow-right ml-2"></i>
                                                </button>
                                            </a>        
                                        <?php endif; ?>

                                        <?php if( isQuizAllowed( $chapter->id ) ): ?>
                                            <a href="<?php echo e(route('quiz', $chapter->id)); ?>">
                                                <button class="btn btn-outline-dark mw130">Quiz
                                                    <i class="icon-arrow-right ml-2"></i>
                                                </button>
                                            </a>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>
    </div>

</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home2/securtac/public_html/securtac/resources/views/training_chapters.blade.php ENDPATH**/ ?>