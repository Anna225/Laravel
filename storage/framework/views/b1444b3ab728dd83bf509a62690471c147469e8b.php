<?php $__env->startSection('content'); ?>
<div class="insite-content">
    <div class="site-part container">
        <form id="new-subscription" class="needs-validation" novalidate method="POST">
            <div class="row">
                <div class="col-md-5 order-md-2 mb-4">
                    <h4 class="d-flex justify-content-between align-items-center mb-3">
                        <span class="text-muted">Selected Services</span>
                    </h4>
                    <ul class="list-group mb-3 service-list">
                        
                        <li class="list-group-item d-flex justify-content-between acc-total list-total">
                            <div>
                                Total
                                <p><i><small>*Price are inclusive of all HST</small></i></p>
                            </div>
                            <span class="ml-auto pr-0"><span class="currency pr-1">$</span><span class="total-price pr-0" id="total-amount">0</span></span>
                        </li>
                    </ul>
                    <noscript style="color:red; font-size:18px;">To register and payment, It is necessary to enable JavaScript. Here are the <a href="http://www.enable-javascript.com" target="_blank"> instructions how to enable JavaScript in your web browser</a></noscript>
                    <div class="card payment-card">
                        <div class="card-header">
                            Payment
                        </div>
                        <div class="card-body">
                            <div class="col-xs-12">
                                <div id="card-element">
                                <!-- A Stripe Element will be inserted here. -->
                                </div>

                                <!-- Used to display Element errors. -->
                                <div id="card-errors" role="alert"></div>
                            </div>
                        </div>
                    </div>
                    <div class="text-right mt-3">
                        <?php echo csrf_field(); ?>
                        <button class="btn btn-primary my-2 my-sm-0 pay_now" disabled>Pay Now</button>
                        <input disabled type="hidden" id="user-name" name="name" value="<?php echo e($user->name); ?>">
                        <input disabled type="hidden" id="user-email" name="email" value="<?php echo e($user->email); ?>">
                    </div>
                    <div class="text-right mt-3">
                        <img alt="Trust Badges" class="mt-2 text-right" style="border: 0;" height="45" src="https://elearning.securtac.ca/public/images/stripe-logo-with-credit-card-logos.png" />
                    </div>
                </div>
                <div class="col-md-7 order-md-1">
                    <h4 class="mb-3">Services </h4>
                        <div class="d-block my-3">
                            <?php $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="custom-control custom-checkbox">

                                    <?php if( isSubscribed( $service->id ) && isSubscribed( $service->id )->status == 'subscribed' ): ?>

                                        <input disabled id="service-<?php echo e($service->id); ?>" type="checkbox" class="custom-control-input" value="<?php echo e($service->id); ?>">
                                        <label class="custom-control-label" for="service-<?php echo e($service->id); ?>"><?php echo e($service->name); ?></label>
                                        <span class="badge badge-success ml-2">Active</span>

                                    <?php elseif( isSubscribed( $service->id ) && isSubscribed( $service->id )->status == 'expired' ): ?>

                                        <input id="service-<?php echo e($service->id); ?>" data-price="<?php echo e($service->price); ?>" data-title="<?php echo e($service->name); ?>" name="services[]" type="checkbox" class="custom-control-input service-checkbox" <?php if( $selectedService->id == $key + 1): ?> checked disabled <?php endif; ?> value="<?php echo e($service->id); ?>">
                                        <label class="custom-control-label" for="service-<?php echo e($service->id); ?>"><?php echo e($service->name); ?></label>
                                        <span class="badge badge-danger ml-2">expired</span>

                                    <?php else: ?>
                                        <input id="service-<?php echo e($service->id); ?>" data-price="<?php echo e($service->price); ?>" data-title="<?php echo e($service->name); ?>" name="services[]" type="checkbox" class="custom-control-input service-checkbox" <?php if( $selectedService->id == $key + 1): ?> checked disabled <?php endif; ?> value="<?php echo e($service->id); ?>">
                                        <label class="custom-control-label" for="service-<?php echo e($service->id); ?>"><?php echo e($service->name); ?></label>    
                                    <?php endif; ?>

                                </div>
                                
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    <hr class="mb-4">
                </div>
            </div>
        </form>
    </div>
</div>
<div class="single-item service-copy" style="display:none;">
    <li class="list-group-item d-flex justify-content-between lh-condensed" data-id="">
        <h6 class="my-0 service-title sel-ser-title"></h6>
        <span class="price-acc pr-0"><small>$<span class="service-amount"></span></small></span>
    </li>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer_scripts'); ?>
<script src="<?php echo e(asset('plugins/jquery-validation/jquery.validate.min.js')); ?>" ></script>
<script src="<?php echo e(asset('plugins/jquery-validation/additional-methods.min.js')); ?>"></script>
<script src="https://js.stripe.com/v3/"></script>
<script>
var services = $(".service-checkbox"),
paymentForm  = $('.payment-card'),
payNow       = $('.pay_now');

$(document).ready(function(){
    // Stripe payment
    var stripe   = Stripe("<?php echo e(config('services.stripe.key')); ?>");
    var elements = stripe.elements();

    // Custom styling can be passed to options when creating an Element.
    var style = {
        base: {
            color: '#32325d',
            lineHeight: '18px',
            fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
            fontSmoothing: 'antialiased',
            fontSize: '16px',
            '::placeholder': {
            color: '#aab7c4'
            }
        },
        invalid: {
            color: '#red',
            ':focus': {
                color: '#FA755A',
            },
            '::placeholder': {
                color: '#FFCCA5',
            },
        },
    };

    var elementClasses = {
        focus: 'focus',
        empty: 'empty',
        invalid: 'invalid',
    };

    // Create an instance of the card Element.
    var card = elements.create('card', {style: style});

    // Add an instance of the card Element into the `card-element` <div>.
    card.mount('#card-element');

    // Handle real-time validation errors from the card Element.
    card.addEventListener('change', function(event) {
        var displayError = document.getElementById('card-errors');
        if (event.error) {
            displayError.textContent = event.error.message;
        } else {
            displayError.textContent = '';
        }
    });

    //process for already checked service
    var total_amount = 0;
    $('#total-amount').text(0);
    payNow.prop('disabled', true);
    $(".service-checkbox:checked").each(function( index, element ) {
        appendService($(this));

        // Calculate the total amount
        total_amount += parseFloat($(this).attr('data-price'));
        $('#total-amount').text(total_amount);
        payNow.prop('disabled', false);
    });

    services.change(function(e) {
        var service_id = $(this).attr('id');

        if ( $(this).is(':checked') ) { // If it's checked
            // append the service
            appendService($(this));
        } else {
            // remove the service
            var service_li = $('.service-list').find('.lh-condensed[data-id="'+service_id+'"]');
            service_li.remove();
        }
        // Update the total
        refreshServiceTotal();
    });

    var $form = $("#new-subscription");
    var formValidator = $form.validate({
            errorClass: "inputError",
            onkeyup: false,
            onfocusout: false,
            rules: {
                'services[]': {
                    required: true,
                },
            },
            messages: {
                'services[]': {
                    required: "Please select service",
                },
            },
            submitHandler: function (form) {

                stripe.createToken(card).then(function(result) {
                    // Enable the service checkbox before submission
                    services.removeAttr("disabled");

                    if (result.error) {
                        // Inform the customer that there was an error.
                        var errorElement = document.getElementById('card-errors');
                        errorElement.textContent = result.error.message;
                    } else {
                        // Create stripe token field
                        if ( $('#stripeToken').length === 0 ) {
                            $('<input>').attr({
                                type: 'hidden',
                                name: 'stripeToken',
                                id: 'stripeToken',
                                value: result.token.id
                            }).appendTo(form);
                        }
                        else {
                            $('#stripeToken').val(result.token.id);
                        }

                        Swal.fire({
                            title: 'Your request is being processed.',
                            text:'Do not refresh or press back button.',
                            showConfirmButton: false,
                            allowOutsideClick: false,
                            onBeforeOpen: () => {
                                Swal.showLoading()
                                $.ajaxSetup({
                                    headers: {
                                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                    }
                                });

                                var name  = $('#user-name').val();
                                var email = $('#user-email').val();
                                var data  = $('form#new-subscription').serialize();
                                $.ajax({
                                    url: "<?php echo e(route('subscribe.action')); ?>",
                                    method: 'POST',
                                    data: data,
                                    dataType: 'json',
                                    success: function(result) {
                                        if ( result.status == 'success' ) {
                                            //$form.trigger("reset");
                                            card.clear();
                                            Swal.fire({
                                                type: 'success',
                                                title: 'Success',
                                                text: result.msg,
                                                allowOutsideClick: false,
                                                allowEscapeKey: false,
                                            }).then((result) => {
                                                if (result.value) {
                                                    window.location.href = "<?php echo e(route('user.dashboard')); ?>";
                                                }
                                            });
                                        } else if( result.status == 'validation_error' ) {
                                            $('#stripeToken').val('');
                                            var err = '';
                                            $.each( result.msg, function( key, value ) {
                                                err += '<li style="color:red;">'+value+'</li>';
                                            });
                                            Swal.fire({
                                                type: 'error',
                                                title: 'Error',
                                                html: err,
                                                allowOutsideClick: false,
                                                allowEscapeKey: false,
                                            });
                                        } else {
                                            // Store the failed payment response to db
                                            $('#stripeToken').val('');
                                            storeTransactionLog(name, email, result.msg, 'Subscription page');
                                            showAlert('error', result.msg);
                                        }
                                    },
                                    error: function (jqXHR, exception) {
                                        var msg = getErrorMsg(jqXHR, exception);                                        
                                        //$form.trigger("reset");

                                        // Store the failed payment response to db
                                        storeTransactionLog(name, email, msg, 'Subscription page');

                                        card.clear(); // Clear the card form
                                        $('#stripeToken').val('');
                                        showAlert('error', msg);
                                    },
                                });
                            }
                        }).then((result) => {
                            console.log('I was closed');
                        })
                    }
                });
            }
        });
});

function appendService(element){
    var service_title  = element.attr('data-title');
    var service_amount = element.attr('data-price');
    var service_id     = element.attr('id');
    $('.service-copy').find('.service-title').text(service_title);
    $('.service-copy').find('.service-amount').text(service_amount);
    $('.service-copy').find('.lh-condensed').attr('data-id', service_id);
    var html = $(".service-copy").html();
    $(html).insertBefore('.list-total');
}

function refreshServiceTotal(){
    var total = 0;
    $('#total-amount').text(0);
    payNow.prop('disabled', true);
    $(".service-checkbox:checked").each(function() {
        total += parseInt($(this).attr('data-price'));
        $('#total-amount').text(total);
        payNow.prop('disabled', false);
    });
}

</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home2/securtac/public_html/securtac/resources/views/subscribe.blade.php ENDPATH**/ ?>