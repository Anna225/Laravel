<!-- footer -->
<footer class="site-footer">
    <div class="footer-big">
        <!-- start .container -->
        <div class="container">
            <div class="row">

                <!-- end /.col-md-4 -->
                <div class="col-md-4 mb-4">
                    <div class="footer-widget">
                        <div class="footer-menu footer-menu--1">
                            <h4 class="footer-widget-title">Quick links </h4>
                            <ul>
                                <li>
                                    <a href="<?php echo e(route('page', 'about-us')); ?>">About Us</a>
                                </li>
                                <li>
                                    <a href="<?php echo e(route('page', 'terms-and-conditions')); ?>">Terms and Conditions</a>
                                </li>
                                <li>
                                    <a href="<?php echo e(route('page', 'privacy-and-policy')); ?>">Privacy and Policy</a>
                                </li>
                                <li>
                                    <a href="<?php echo e(route('page', 'refund-policy')); ?>">Refund Policy</a>
                                </li>
                                <li>
                                    <a href="<?php echo e(route('page', 'faq')); ?>">FAQ</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 mb-4">
                    <div class="footer-widget">
                        <div class="footer-menu">
                            <h4 class="footer-widget-title">COURSES</h4>
                            <ul>
                                <li>
                                    <?php if( ! Auth::guard()->check() ): ?>
                                        <a href="<?php echo e(route('register', ['service' => 1])); ?>">
                                            <?php echo e(getServiceDetail(1, 'name')); ?>

                                        </a>
                                    <?php elseif( ! isSubscribed( 1 )): ?>
                                        <a href="<?php echo e(route('subscribe', 1 )); ?>">
                                            <?php echo e(getServiceDetail(1, 'name')); ?>

                                        </a>
                                    <?php elseif( isSubscribed( 1 )->status == 'subscribed' ): ?>
                                        <a href="<?php echo e(route("training_chapters")); ?>">
                                            <?php echo e(getServiceDetail(1, 'name')); ?>

                                        </a>
                                    <?php else: ?>
                                        <a href="<?php echo e(route('subscribe', 1 )); ?>">
                                            <?php echo e(getServiceDetail(1, 'name')); ?>

                                        </a>
                                    <?php endif; ?>
                                </li>
                                <li>
                                    <?php if( ! Auth::guard()->check() ): ?>
                                        <a href="<?php echo e(route('register', ['service' => 2])); ?>"> <?php echo e(getServiceDetail(2, 'name')); ?> </a>
                                    <?php elseif( ! isSubscribed( 2 )): ?>
                                        <a href="<?php echo e(route('subscribe', 2 )); ?>"> <?php echo e(getServiceDetail(2, 'name')); ?> </a>
                                    <?php elseif( isSubscribed( 2 )->status == 'subscribed' ): ?>
                                        <a href="<?php echo e(route("schedule", 2 )); ?>"> <?php echo e(getServiceDetail(2, 'name')); ?> </a>
                                    <?php else: ?>
                                        <a href="<?php echo e(route('subscribe', 2 )); ?>"> <?php echo e(getServiceDetail(2, 'name')); ?> </a>
                                    <?php endif; ?>
                                </li>
                                <li>
                                    <?php if( ! Auth::guard()->check() ): ?>
                                        <a href="<?php echo e(route('register', ['service' => 3])); ?>"> <?php echo e(getServiceDetail(3, 'name')); ?> </a>
                                    <?php elseif( ! isSubscribed( 3 )): ?>
                                        <a href="<?php echo e(route('subscribe', 3 )); ?>"> <?php echo e(getServiceDetail(3, 'name')); ?> </a>
                                    <?php elseif( isSubscribed( 3 )->status == 'subscribed' ): ?>
                                        <a href="<?php echo e(route("schedule", 3)); ?>"> <?php echo e(getServiceDetail(3, 'name')); ?> </a>
                                    <?php else: ?>
                                        <a href="<?php echo e(route('subscribe', 3 )); ?>"> <?php echo e(getServiceDetail(3, 'name')); ?> </a>
                                    <?php endif; ?>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 mb-4">
                    <div class="footer-widget">
                        <div class="footer-menu no-padding">
                            <h4 class="footer-widget-title">contact Us</h4>
                            <ul class="no-disc">
                                <li>
                                    <?php if( getMetaValue('public_address') ): ?>
                                        <p><img src="<?php echo e(asset('images/map.png')); ?>"><?php echo e(getMetaValue('public_address')); ?></p>
                                    <?php endif; ?>
                                </li>
                                <li>
                                    <?php if( getMetaValue('public_phone') ): ?>
                                        <a href="tel:<?php echo e(getMetaValue('public_phone')); ?>"><img src="<?php echo e(asset('images/call.png')); ?>"><?php echo e(getMetaValue('public_phone')); ?></a>
                                    <?php endif; ?>
                                </li>
                                <li>
                                    <?php if( getMetaValue('public_email') ): ?>
                                        <a href="mailto:<?php echo e(getMetaValue('public_email')); ?>"><img src="<?php echo e(asset('images/mail.png')); ?>"><?php echo e(getMetaValue('public_email')); ?></a>
                                    <?php endif; ?>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="mini-footer">
        <div class="container">
            <div class="row">
                <div class="col-md-6 text-left">
                    <div>
                        <p>Copyright ©<?php echo e(date('Y')); ?> Securtac Protection Services Inc.All Rights Reserved</p>
                    </div>
                </div>
                <div class="col-md-6 soc-links text-right">
                    <?php if( getMetaValue('instagram_link') ): ?>
                        <a target="_blank" href="<?php echo e(getMetaValue('instagram_link')); ?>">
                            <img src="<?php echo e(asset('images/insta.png')); ?>">
                        </a>
                    <?php endif; ?>

                    <?php if( getMetaValue('facebook_link') ): ?>
                        <a target="_blank" href="<?php echo e(getMetaValue('facebook_link')); ?>">
                            <img src="<?php echo e(asset('images/facebook.png')); ?>">
                        </a>
                    <?php endif; ?>

                    <?php if( getMetaValue('linkedin_link') ): ?>
                        <a target="_blank" href="<?php echo e(getMetaValue('linkedin_link')); ?>">
                            <img src="<?php echo e(asset('images/linkdin.png')); ?>">
                        </a>
                    <?php endif; ?>

                    <?php if( getMetaValue('twitter_link') ): ?>
                        <a target="_blank" href="<?php echo e(getMetaValue('twitter_link')); ?>">
                            <img src="<?php echo e(asset('images/twitter.png')); ?>">
                        </a>
                    <?php endif; ?>

                </div>
            </div>
        </div>
    </div>
</footer>
<div id="siteNoticeBar"></div><?php /**PATH /home2/securtac/public_html/securtac/resources/views/partials/footer.blade.php ENDPATH**/ ?>