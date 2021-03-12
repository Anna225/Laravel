<?php $user = auth()->user(); ?>
<div class="invite-div">
    <div class="row align-items-center">
        <div class="col-md-6 text-center">
            <img src="<?php echo e(asset('images/invite_earn.svg')); ?>" width="70%">
        </div>

        <div class="col-md-6 text-center">
            <h5 class="fw-900"><?php echo e(getMetaValue('referral_heading') ?? 'Invite Your Friends and Earn Gifts'); ?></h5>
            <p class="mt-3 mb-3"><?php echo nl2br( getMetaValue('referral_subheading') ) ?? 'Share your referral code with your dear ones and earn gifts'; ?></p>

            <div class="text-center">
                <button class="btn btn-primary-o btn-invite" data-user="<?php echo e($user->id); ?>">Invite <i class="fas fa-fw fa-paper-plane"></i></button>
            </div>
        </div>
    </div>
</div><?php /**PATH /home2/securtac/public_html/securtac/resources/views/partials/referral_block.blade.php ENDPATH**/ ?>