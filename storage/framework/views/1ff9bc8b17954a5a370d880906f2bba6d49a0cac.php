<?php $__env->startSection('header_scripts'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('css/swiper.min.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="site-content main-content">
    <div class="swiper-container top-slider">
        <div class="swiper-wrapper">

            <?php $__empty_1 = true; $__currentLoopData = $homeSlides; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $slide): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>

                <div class="swiper-slide" style="background-image:url( <?php echo e(asset($slide->image_url)); ?> )">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-6">
                                <h1 class="swipe-title" data-scrollreveal="enter bottom after 0.1s">
                                   <?php echo e($slide->heading); ?>

                                </h1>
                                <p class="swipe-desc" data-scrollreveal="enter bottom after 0.2s">
                                    <?php echo e($slide->subheading); ?>

                                </p>
                                <?php if( $key == 0 ): ?>
                                    <?php if( ! Auth::guard()->check() ): ?>
                                        <a href="<?php echo e(route('register', ['service' => 1])); ?>">
                                            <button class="btn btn-primary mt-5 btn-subscribe"> Enroll Now
                                                <i class="icon-arrow-right ml-2"></i>
                                            </button>
                                        </a>
                                    <?php elseif( ! isSubscribed( 1 )): ?>
                                        <a href="<?php echo e(route('subscribe', 1 )); ?>">
                                            <button class="btn btn-primary mt-5 btn-subscribe"> Enroll Now
                                                <i class="icon-arrow-right ml-2"></i>
                                            </button>
                                        </a>
                                    <?php elseif( isSubscribed( 1 )->status == 'subscribed' ): ?>
                                        <a href="<?php echo e(route("training_chapters")); ?>">
                                            <button class="btn btn-primary mt-5 btn-subscribe"> Study Now
                                                <i class="icon-arrow-right ml-2"></i>
                                            </button>
                                        </a>
                                    <?php else: ?>
                                        <a href="<?php echo e(route('subscribe', 1 )); ?>">
                                            <button class="btn btn-primary mt-5 btn-subscribe"> Renew Now
                                                <i class="icon-arrow-right ml-2"></i>
                                            </button>
                                        </a>
                                    <?php endif; ?>
                                <?php elseif($key == 1): ?>
                                    <a class="btn btn-primary mt-5 scroll_to" data-scrollreveal="enter bottom after 0.3s" href="#first-aid-block" id="first-aid-cta">
                                        <?php echo e($slide->cta_label); ?>

                                        <i class="icon-arrow-right ml-2"></i>
                                    </a>
                                <?php else: ?>
                                    <a class="btn btn-primary mt-5" data-scrollreveal="enter bottom after 0.3s" target="<?php echo e($slide->cta_target); ?>" href="<?php echo e($slide->cta_link); ?>">
                                        <?php echo e($slide->cta_label); ?>

                                        <i class="icon-arrow-right ml-2"></i>
                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>

            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                No Slides Found.
            <?php endif; ?>
        </div>
        <!-- Add Pagination -->
        <div class="container">
            <div class="swiper-pagination swiper-pagination-white"></div>
        </div>
    </div>

    <!-- About us -->
    <div class="about-div">
        <div class="container">
            <div class="row align-items-center">

                <div class="col-md-6 rightsquare reveal" data-scrollreveal="enter bottom after 0.3s">
                    <img src="<?php echo e(asset('images/about-us.jpg')); ?>" width="100%">
                </div>

                <div class="col-lg-1"></div>

                <div class="col-md-6 col-lg-5 ">
                    <div class="sec-title">
                        
                        <h1 class="reveal" data-scrollreveal="enter bottom after 0.15s">About our certified courses</h1>
                        <p class="reveal" data-scrollreveal="enter bottom after 0.25s" class="mt-3 mb-3">Looking to become a security guard? Securtac Protection Services has the right training module for you to pass your Ontario Security Guard Licence Exam.</p>
                        <p class="reveal" data-scrollreveal="enter bottom after 0.30s" class="mt-3 mb-3">SPS follows the guidelines outlined by the Private Security and Investigation Act, 2005 (PSISA) and give you a more in-depth and extensive learning experience to enable you to pass the Ontario Security Guard test.</p>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- About us -->
    <div class="about-div">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6 col-lg-5">
                    <div class="sec-title">
                        <h1 class="reveal" data-scrollreveal="enter bottom after 0.15s">First Aid with CPR and AED Courses</h1>
                        <p class="reveal" data-scrollreveal="enter bottom after 0.25s" class="mt-3 mb-3">Our courses and instructors are certified and provided through Rescue 7.</p>
                        <p class="reveal" data-scrollreveal="enter bottom after 0.35s" class="mt-3 mb-3">As required, those who want to become a security guard must take the 1 day, 6.5-hour course of the Emergency First Aid with CPR Level C and AED course.</p>
                        <p class="reveal" data-scrollreveal="enter bottom after 0.35s" class="mt-3 mb-3">Training is not limited to security guards only. In addition to the Emergency First Aid with CPR (1-day course), we also provide the Standard First Aid & CPR Level C with AED (2-day course) & the Recertification course (6.5 hour) for any job that requires it.</p>
                        <p class="reveal" data-scrollreveal="enter bottom after 0.40s" class="mt-3 mb-3">Our courses are approved federally by Employment and Social Development Canada (ESDC) and provincially by its applicable Workers Safety & Insurance Board. All certifications are valid for three (3) years from the date of the course. Recertification can only be done once, and the current certificate must be valid upon doing the course and be issued bye Rescue 7 only.</p>
                        <p class="reveal" data-scrollreveal="enter bottom after 0.45s" class="mt-3 mb-3">We recommend that if you enroll in any of the courses to dress comfortably since this will be hands on training.</p>
                        <p class="reveal" data-scrollreveal="enter bottom after 0.45s" class="mt-3 mb-3">CONTACT US FOR GROUP/CORPORATE FIRST AID CPR TRAINING</p>
                        <a target="_blank" href="https://securtac.ca/contact/" class="btn btn-primary mt-3 first-aid-cta">CONTACT US</a>
                    </div>
                </div>

                <div class="col-lg-1"></div>

                <div class="col-md-6 rightsquare reveal" data-scrollreveal="enter bottom after 0.3s">
                    <img src="<?php echo e(asset('images/first-aid-securtac.jpg')); ?>" width="100%">
                </div>
            </div>
        </div>
    </div>

    <div class="servicediv">
        <div class="container">
        	<div class="sec-title text-center mb-4">
	            
	            <h1>Our Services</h1>
	        </div>
            <div class="row">
                <div class="col-12 mb-5">
                    <div class="row align-items-center nobefore">
                        <div class="col-md-6 col-lg-4 reveal" data-scrollreveal="enter bottom after 0.3s">
                            <div class="service-plate">
                                <div class="service-top">
                                    <img src="<?php echo e(getServiceDetail(1,'image_url')); ?>" width="100%">
                                </div>
                                <div class="service-desc">
                                    <h3><?php echo e(getServiceDetail(1,'name')); ?></h3>
                                    <p>Benefits of taking our online Ontario security guard training:</p>
                                    <ul class="list-service-benefits">
                                        <li>Flexible schedule and environment</li>
                                        <li>Easy accessibility</li>
                                        <li>Learn at your own pace</li>
                                        <li>No commuting required</li>
                                        <li>Chat online with an instructor</li>
                                    </ul>
                                    <h4>$<?php echo e(getServiceDetail(1,'price_without_tax')); ?></h4>
                                </div>
                                <div class="text-center bottom-alt">
                                    <?php if( ! Auth::guard()->check() ): ?>
                                        <a href="<?php echo e(route('register', ['service' => 1])); ?>">
                                            <button class="btn btn-primary btn-subscribe"> Enroll Now
                                                <i class="icon-arrow-right ml-2"></i>
                                            </button>
                                        </a>
                                    <?php elseif( ! isSubscribed( 1 )): ?>
                                        <a href="<?php echo e(route('subscribe', 1 )); ?>">
                                            <button class="btn btn-primary btn-subscribe"> Enroll Now
                                                <i class="icon-arrow-right ml-2"></i>
                                            </button>
                                        </a>
                                    <?php elseif( isSubscribed( 1 )->status == 'subscribed' ): ?>
                                        <a href="<?php echo e(route("training_chapters")); ?>">
                                            <button class="btn btn-primary btn-subscribe"> Study Now
                                                <i class="icon-arrow-right ml-2"></i>
                                            </button>
                                        </a>
                                    <?php else: ?>
                                        <a href="<?php echo e(route('subscribe', 1 )); ?>">
                                            <button class="btn btn-primary btn-subscribe"> Renew Now
                                                <i class="icon-arrow-right ml-2"></i>
                                            </button>
                                        </a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-8">
                            <h5 class="mb-3"><b>We are licensed training provider by the Ontario Private
                                    Security and Investigative Services</b></h5>
                            <p>Our seurity guard training syllabus is compiled of 40 hours. Where 33.5 hours of the
                                course material can be reviewed online, and 6.5 hours of the Emergency First Aid &
                                CPR is done in class only at our Scarborough Facility.</p>
                            <p class="mt-4"><b>Course material covered:</b></p>
                            <ul class="pl-4">
                                <li>Introduction to the Security Industry</li>
                                <li>The Private Security and InvestigativeServices Act and Code of Conduct
                                    regulation</li>
                                <li>Basic Security Procedures</li>
                                <li>Report Writing</li>
                                <li>Health and Safety</li>
                                <li>Emergency Response Preparation</li>
                                <li>Canadian Legal System</li>
                                <li>Legal Authorities</li>
                                <li>Effective Communications</li>
                                <li>Sensitivity Training</li>
                                <li>Use of Force Theory</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-12 mb-5" id="first-aid-block">
                    <div class="row align-items-center reverse-row">
                        <div class="col-md-6 col-lg-8">
                            <h5 class="mb-3"><b>Course meets legislation requirements for provincial/territorial worker safety and insurance boards and includes the latest first aid and CPR guidelines.</b></h5>
                            <p class="mt-4"><b>Registrants will learn the following: </b></p>
                            <ul class="pl-4">
                                <li>Legalities</li>
                                <li>Disease Management & Biohazards</li>
                                <li>The Emergency Medical Services System</li>
                                <li>Scene Management</li>
                                <li>Head, Spine and Pelvic Injuries</li>
                                <li>Bleeding Management and Shock</li>
                                <li>Cardiovascular Emergencies</li>
                                <li>Sudden Medical Conditions</li>
                                <li>Airway and Breathing Emergencies</li>
                                <li>CPR (Cardiopulmonary Resuscitation)</li>
                                <li>AED Overview</li>

                            </ul>
                        </div>
                        <div class="col-md-6 col-lg-4 reveal" data-scrollreveal="enter bottom after 0.4s">
                            <div class="service-plate">
                                <div class="service-top">
                                    <img src="<?php echo e(getServiceDetail(2, 'image_url')); ?>" width="100%">
                                </div>
                                <div class="service-desc">
                                    <h3><?php echo e(getServiceDetail(2, 'name')); ?></h3>
                                    <p><?php echo e(getServiceDetail(2, 'description')); ?></p>
                                    <h4>$<?php echo e(getServiceDetail(2, 'price_without_tax')); ?></h4>
                                </div>
                                <div class="text-center bottom-alt">
                                    <?php if( ! Auth::guard()->check() ): ?>
                                        <a href="<?php echo e(route('register', ['service' => 2])); ?>">
                                            <button class="btn btn-primary btn-subscribe"> Enroll Now
                                                <i class="icon-arrow-right ml-2"></i>
                                            </button>
                                        </a>
                                    <?php elseif( ! isSubscribed( 2 )): ?>
                                        <a href="<?php echo e(route('subscribe', 2 )); ?>">
                                            <button class="btn btn-primary btn-subscribe"> Enroll Now
                                                <i class="icon-arrow-right ml-2"></i>
                                            </button>
                                        </a>
                                    <?php elseif( isSubscribed( 2 )->status == 'subscribed' ): ?>
                                        <a href="<?php echo e(route("schedule", 2 )); ?>">
                                            <button class="btn btn-primary btn-subscribe"> Schedule
                                                <i class="icon-arrow-right ml-2"></i>
                                            </button>
                                        </a>
                                    <?php else: ?>
                                        <a href="<?php echo e(route('subscribe', 2 )); ?>">
                                            <button class="btn btn-primary btn-subscribe"> Renew Now
                                                <i class="icon-arrow-right ml-2"></i>
                                            </button>
                                        </a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 mb-5">
                    <div class="row align-items-center">
                        <div class="col-md-6 col-lg-4 reveal" data-scrollreveal="enter bottom after 0.4s">
                            <div class="service-plate">
                                <div class="service-top">
                                    <img src="<?php echo e(getServiceDetail(3, 'image_url')); ?>" width="100%">
                                </div>
                                <div class="service-desc">
                                    <h3><?php echo e(getServiceDetail(3, 'name')); ?></h3>
                                    <p><?php echo e(getServiceDetail(3, 'description')); ?></p>
                                    <h4>$<?php echo e(getServiceDetail(3, 'price_without_tax')); ?></h4>
                                </div>
                                <div class="text-center bottom-alt">
                                    <?php if( ! Auth::guard()->check() ): ?>
                                        <a href="<?php echo e(route('register', ['service' => 3])); ?>">
                                            <button class="btn btn-primary btn-subscribe"> Enroll Now
                                                <i class="icon-arrow-right ml-2"></i>
                                            </button>
                                        </a>
                                    <?php elseif( ! isSubscribed( 3 )): ?>
                                        <a href="<?php echo e(route('subscribe', 3 )); ?>">
                                            <button class="btn btn-primary btn-subscribe"> Enroll Now
                                                <i class="icon-arrow-right ml-2"></i>
                                            </button>
                                        </a>
                                    <?php elseif( isSubscribed( 3 )->status == 'subscribed' ): ?>
                                        <a href="<?php echo e(route("schedule", 3)); ?>">
                                            <button class="btn btn-primary btn-subscribe"> Schedule
                                                <i class="icon-arrow-right ml-2"></i>
                                            </button>
                                        </a>
                                    <?php else: ?>
                                        <a href="<?php echo e(route('subscribe', 3 )); ?>">
                                            <button class="btn btn-primary btn-subscribe"> Renew Now
                                                <i class="icon-arrow-right ml-2"></i>
                                            </button>
                                        </a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-8">
                            <h5 class="mb-3"><b>CPR/AED (Level C) focuses on lifesaving skills on the adult, child and baby.</b></h5>
                            <p>This course covers a wide range of First Aid injuries, illnesses and life threatening emergencies.</p>
                            <p class="mt-4"><b>You will learn:</b></p>
                            <ul class="pl-4">
                                <li>Preparing to Respond – Introduction</li>
                                <li>Emergency Medical System (911)</li>
                                <li>Recovery Position (unconscious breathing)</li>
                                <li>CPR for adults, children and babies</li>
                                <li>Automated external defibrillator (AED)</li>
                                <li>Heart attack/Angina & Stroke/TIA</li>
                                <li>Choking (adults, children and babies)</li>
                                Responding as a “team”
                            </ul>
                            <p class="mt-4"><b>CPR/AED (BLS) for health care providers covers additional advanced skills including:</b></p>
                            <ul class="pl-4">
                                <li> Check (adult, child, infant)</li>
                                <li>Two-Rescuer Rescue Breathing (Artificial Respiration)</li>
                                <li>Two-Rescuer CPR (adult, child, baby)</li>
                                <li>How to use a BVM (Bag Valve Mask) and pocet mask in a two rescuer team</li>
                                <li>Airway management for blunt force trauma (jaw thrust)</li>
                                <li>AED protocols for witnessed and un-witnessed arrest</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-12 mb-5">
                    <div class="row align-items-center reverse-row">
                        <div class="col-md-6 col-lg-8">
                            <h5 class="mb-3"><b>This course covers a wide range of First Aid injuries, illnesses and life threatening emergencies.</b></h5>
                            <p class="mt-4"><b>Registrants will learn the following: </b></p>
                            <ul class="pl-4">
                                <li>Preparing to Respond – Introduction</li>
                                <li>Emergency Medical System (911)</li>
                                <li>Recovery Position (unconscious breathing)</li>
                                <li>CPR for adults, children and babies</li>
                                <li>Automated external defibrillator (AED)</li>
                                <li>Heart attack/Angina & Stroke/TIA</li>
                                <li>Choking (adults, children and babies)</li>
                                <li>Responding as a “team”</li>
                                <li>Anaphylactic Shock (severe allergy) and Asthma</li>
                                <li>Deadly bleeding – internal and external</li>
                                <li>Amputations – partial and complete / Impaled objects</li>
                                <li>Shock/Fainting</li>
                                <li>Wound Basics (minor cuts, scrapes, punctures, bruises and burns)</li>
                                <li>Secondary Survey</li>
                                <li>Head & spinal injuries</li>
                                <li>Muscle, bone & joint injuries</li>
                                <li>Burns (heat, chemical, electrical, sun)</li>
                                <li>Diabetic emergencies</li>
                                <li>Seizures or Convulsions (includes infant/child high fever)</li>
                                <li>Heat Cramps, Heat Exhaustion and Heat Stroke</li>
                                <li>Poisoning</li>
                            </ul>
                        </div>
                        <div class="col-md-6 col-lg-4 reveal" data-scrollreveal="enter bottom after 0.4s">
                            <div class="service-plate">
                                <div class="service-top">
                                <img src="<?php echo e(asset('images/first_aid_2_days.jpg')); ?>" width="100%">
                                </div>
                                <div class="service-desc">
                                    <h3>Standard First Aid with CPR Level C and AED Training (2-day Course)</h3>
                                    <p>Registrants will learn everything from the Emergency First Aid course plus the following:</p>
                                    <ul class="list-service-benefits">
                                        <li>Secondary Survey</li>
                                        <li>Musculoskeletal Injuries</li>
                                        <li>Burns</li>
                                        <li>Poisons, Substance Abuse and Misuse</li>
                                        <li>Environmental injuries and illnesses</li>
                                        <li>Contact Us (button)</li>
                                    </ul>
                                    <h4>$<?php echo e(getServiceDetail(2, 'price_without_tax')); ?></h4>
                                </div>
                                <div class="text-center bottom-alt">
                                    <a href="https://securtac.ca/contact/" target="_blank">
                                        <button class="btn btn-primary btn-subscribe"> Contact Us
                                            <i class="icon-arrow-right ml-2"></i>
                                        </button>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- our process -->
    <div class="process-div">
        <div class="sec-title">
            
            <h1>Our Process</h1>
        </div>

        <div class="process-plate">
            <div class="container">
                <div class="row m-0">
                    <div class="col-6 col-sm-4 col-lg-2 text-center on-hover">
                        <div class="proc-icon rl-proc">
                            <i class="icon-registration"></i>
                        </div>
                        <div class="proc-desc">
                            <h5>1. Registration</h5>
                        </div>
                        <div class="over-hover">
                            <p>Create your profile to begin registering for our online Ontario security guard courses</p>
                        </div>
                    </div>
                    <div class="col-6 col-sm-4 col-lg-2 text-center on-hover">
                        <div class="proc-icon ll-proc">
                            <i class="icon-payment"></i>
                        </div>
                        <div class="proc-desc">
                            <h5>2. Payment</h5>
                        </div>
                        <div class="over-hover">
                            <p>We accept all major credits online securely. Contact us should you want to send e-transfers or stop by our head office to pay in person</p>
                        </div>
                    </div>
                    <div class="col-6 col-sm-4 col-lg-2 text-center on-hover">
                        <div class="proc-icon rl-proc">
                            <i class="icon-read"></i>
                        </div>
                        <div class="proc-desc">
                            <h5>3. Training</h5>
                        </div>
                        <div class="over-hover">
                            <p>View course materials online and complete the exercises
                            </p>
                        </div>
                    </div>
                    <div class="col-6 col-sm-4 col-lg-2 text-center on-hover">
                        <div class="proc-icon ll-proc">
                            <i class="icon-results"></i>
                        </div>
                        <div class="proc-desc">
                            <h5>4. Completion</h5>
                        </div>
                        <div class="over-hover">
                            <p>Pass our final test to receive your certificate from our agency.</p>
                        </div>
                    </div>
                    <div class="col-6 col-sm-4 col-lg-2 text-center on-hover">
                        <div class="proc-icon rl-proc">
                            <i class="icon-badge"></i>
                        </div>
                        <div class="proc-desc">
                            <h5>5. Ministry Test</h5>
                        </div>
                        <div class="over-hover">
                            <p>Upon successful completion of the course, we will notify you within 2 business days by email with your unique testing completion number (TCN). With your TCN you can register to write the Ontario security guard test at <a href="https://ontariosecuritytesting.com/" target="_blank" rel="nofollow" >https://ontariosecuritytesting.com/.</a> You must visit one of their testing locations to write the test.</p>
                        </div>
                    </div>
                    <div class="col-6 col-sm-4 col-lg-2 text-center on-hover">
                        <div class="proc-icon ll-proc">
                            <i class="icon-certificate"></i>
                        </div>
                        <div class="proc-desc">
                            <h5>6. Get Licensed</h5>
                        </div>
                        <div class="over-hover">
                           <p>Your test results will be available at <a href="https://ontariosecuritytesting.com" target="_blank">https://ontariosecuritytesting.com</a> in 1 to 2 weeks. If you have passed you can send your application to the Private Security and Investigative services office for processing to become licensed or online by visiting <a href="https://www.one-key.gov.on.ca/" rel="nofollow" target="_blank">https://www.one-key.gov.on.ca/.</a> Be sure to create a ONe-key ID. </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer_scripts'); ?>
<script src="<?php echo e(asset('js/swiper.min.js')); ?> "></script>
<script>
$(document).ready(function (){
    //first-aid-cta
    $("#first-aid-cta").click(function(e) {
        var jump = $(this).attr('href');
        var new_position = $(jump).offset();
        $('html, body').animate({ scrollTop: new_position.top }, 'slow');
    });
});

var swiper = new Swiper('.top-slider', {
    effect: 'fade',
    autoplay: true,
    pagination: {
        el: '.swiper-pagination',
        clickable: true,
    },
});

var testiSwiper = new Swiper('.testi-swiper', {
    slidesPerView: 3,
    spaceBetween: 0,
    loop: true,
    autoplay: true,
    breakpoints: {
        320: {
            slidesPerView: 1,
        },
        768: {
            slidesPerView: 2,
        },
        1024: {
            slidesPerView: 3,
        },
    },
    navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
    },
});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', ['menu_type' => 'light'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home2/securtac/public_html/securtac/resources/views/home.blade.php ENDPATH**/ ?>