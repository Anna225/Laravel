@extends('layouts.app')

@section('header_scripts')
<link rel="stylesheet" href="{{ asset('plugins/bootstrap-datepicker/bootstrap-datepicker3.min.css') }}">
@endsection

@section('content')
<div class="site-content">
    <div class="register-wrapper">
        <div class="container">
            <form method="POST" action="{{ route('register') }}" id="registration-form">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="login-div">
                            <div class="sec-title">
                                <h1>Course Registration</h1>
                            </div>

                            <div class="mt-5">
                                <div class="row">
                                    <div class="form-group col-12 col-sm-6">
                                        <input type="text" name="first_name" class="form-control @error('first_name') is-invalid @enderror" placeholder="First Name*" id="first-name" autocomplete="first-name">

                                        @error('first_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="form-group col-12 col-sm-6">
                                        <input type="text" name="last_name" class="form-control @error('last_name') is-invalid @enderror" placeholder="Last Name*" id="last-name" autocomplete="last-name">

                                        @error('last_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="form-group col-12">
                                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email Address*" id="email">

                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="form-group col-12">
                                        <input type="number" name="mobile_number" class="form-control @error('mobile_number') is-invalid @enderror" id="inputMobile" placeholder="Phone Number">

                                        @error('mobile_number')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="form-group col-12">
                                        <input type="text" name="birth_date" id="inputDate" class="form-control birth_date @error('birth_date') is-invalid @enderror" placeholder="Birthday*" autocomplete="off">

                                        @error('birth_date')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="form-group col-12">
                                        <input type="text" class="form-control @error('address_line_1') is-invalid @enderror" name="address_line_1" placeholder="Street Number & Street Name" required>

                                        @error('address_line_1')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="form-group col-12">
                                        <input type="text" class="form-control @error('address_line_2') is-invalid @enderror" name="address_line_2" placeholder="Apartment/Unit Number">

                                        @error('address_line_2')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="form-group col-12 col-sm-6">
                                        <input required type="text" class="form-control @error('city') is-invalid @enderror" name="city" placeholder="City">

                                        @error('city')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="form-group col-12 col-sm-6">
                                        <input required type="text" class="form-control @error('state') is-invalid @enderror" name="state" placeholder="Province/State">

                                        @error('state')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="form-group col-12 col-sm-6">
                                        <input required type="text" class="form-control @error('postal_code') is-invalid @enderror" name="postal_code" placeholder="Postal Code">

                                        @error('postal_code')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="form-group col-12 col-sm-6">
                                        <input required type="text" class="form-control" name="country" placeholder="Country" autocomplete="country">

                                        @error('country')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="form-group col-12">
                                        <input required type="password" class="form-control" name="password" placeholder="Password" id="password" autocomplete="new-password">

                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="form-group col-12">
                                        <input required name="password_confirmation" type="password" class="form-control" id="password-confirm" placeholder="Confirm Password" autocomplete="new-password">
                                    </div>
                                    <div class="form-group col-12">
                                    <input type="hidden" class="form-control @error('referral_code') is-invalid @enderror" name="referral_code" placeholder="Referral Code" value="{{ $referralCode }}" autocomplete="off">
                                    </div>
                                    <div class="form-check col-12">
                                        <label class="custom-checkbox fw-700"> I agree with the term’s & conditions
                                            <input required type="checkbox" name="terms_condition">
                                            <span class="checkmark smallcheck"></span>
                                        </label>
                                    </div>
                                    <div class="form-check col-12">
                                        <label class="custom-checkbox fw-700"> Sign up for upcoming promotions and news & giveaways
                                            <input required type="checkbox" name="mailchimp_signup" checked="checked">
                                            <span class="checkmark smallcheck"></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="sec-title mt-5 mb-4">
                            <h1>Training Courses</h1>
                        </div>

                        <div class="accordion" id="accordionExample">
                            <div class="card">
                                <div class="card-header choice-acc" id="headingOne" data-toggle="collapse"
                                    data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    <h6 class="mb-0 disflexc">
                                        <label class="custom-checkbox fw-700">
                                            <span class="check-label">{{ $services[0]->name }}</span>
                                            <input class="service-checkbox" data-price="{{ $services[0]->price }}" type="checkbox" name="services[]" value="1" @if (request()->has('service') && request()->get('service') == '1' ) checked @endif>
                                            <span class="checkmark"></span>
                                        </label>
                                        <span class="price-acc"><sup>$</sup>{{ $services[0]->price_without_tax }}</span>
                                    </h6>
                                </div>

                                <div id="collapseOne" class="collapse show" aria-labelledby="headingOne"
                                    data-parent="#accordionExample">
                                    <div class="card-body acc-body">{{ $services[0]->description }}</div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header choice-acc" id="headingTwo" data-toggle="collapse"
                                    data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    <h6 class="mb-0 disflexc">
                                        <label class="custom-checkbox fw-700">
                                            <span class="check-label">{{ $services[1]->name }}</span>
                                            <input class="service-checkbox" data-price="{{ $services[1]->price }}" type="checkbox" name="services[]" value="2" @if (request()->has('service') && request()->get('service') == '2' ) checked @endif>
                                            <span class="checkmark"></span>
                                        </label>
                                        <span class="price-acc"><sup>$</sup>{{ $services[1]->price_without_tax }}</span>
                                    </h6>
                                </div>
                                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo"
                                    data-parent="#accordionExample">
                                    <div class="card-body acc-body">{{ $services[1]->description }}</div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header choice-acc" id="headingThree" data-toggle="collapse"
                                    data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                    <h6 class="mb-0 disflexc">
                                        <label class="custom-checkbox fw-700">
                                            <span class="check-label">{{ $services[2]->name }}</span>
                                            <input class="service-checkbox" data-price="{{ $services[2]->price }}" type="checkbox" name="services[]" value="3" @if (request()->has('service') && request()->get('service') == '3' ) checked @endif>
                                            <span class="checkmark"></span>
                                        </label>
                                        <span class="price-acc"><sup>$</sup>{{ $services[2]->price_without_tax }}</span>
                                    </h6>
                                </div>
                                <div id="collapseThree" class="collapse" aria-labelledby="headingThree"
                                    data-parent="#accordionExample">
                                    <div class="card-body acc-body">{{ $services[2]->description }}</div>
                                </div>
                            </div>
                            <label for="services[]" class="inputError" id="services[]-error" hidden>Please select at least true service</label>
                        </div>
                        <div class="acc-total">
                            <div>
                                Total
                                 <p><i><small>*Includes 13% HST</small></i></p>
                            </div>
                                <span class="ml-auto"><sup class="currency">$</sup><span class="total-price" id="total">0</span></span>
                        </div>
                        <br />
                        <noscript style="color:red; font-size:18px;">To register and payment, It is necessary to enable JavaScript. Here are the <a href="http://www.enable-javascript.com" target="_blank"> instructions how to enable JavaScript in your web browser</a></noscript>
                        <div class="card payment-card" hidden>
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
                            @csrf
                            <button class="btn btn-primary my-2 my-sm-0 pay_now" disabled>Pay Now</button>
                        </div>
                        <div class="text-right mt-3">
                            <img alt="Trust Badges" class="mt-2 text-right" style="border: 0;" height="45" src="https://elearning.securtac.ca/public/images/stripe-logo-with-credit-card-logos.png" />
                        </div>
                    </div>
                </div>
                <!-- /. row -->
            </form>
        </div>
        <!-- /. Container -->
    </div>
</div>
<!-- /. site-conent -->
@endsection

@section('footer_scripts')
<script src="{{ asset('plugins/jquery-validation/jquery.validate.min.js') }}" ></script>
<script src="{{ asset('plugins/jquery-validation/additional-methods.min.js') }}"></script>
<script src="{{ asset('plugins/moment/moment.min.js') }}"></script>
<script src="{{ asset('plugins/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
<script src="https://js.stripe.com/v3/"></script>
<script>
    $(document).ready(function (e) {
        // validate the credit card form

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // Birthdate picker
        $('#inputDate').datepicker({});

        // Sripe payment
        var stripe   = Stripe("{{ config('services.stripe.key') }}");
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
        var card = elements.create('card', {style: style, hidePostalCode:true});

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

        var services = $(".service-checkbox"),
        paymentForm  = $('.payment-card'),
        payNow       = $('.pay_now');

        // Check if it's already checked
        if ( $(".service-checkbox:checked").length  > 0) {
            paymentForm.removeAttr('hidden');
            payNow.removeAttr('disabled');
        }

        var total_amount = 0;
        $(".service-checkbox:checked").each(function() {
            total_amount += parseFloat($(this).attr('data-price'));
            if ( total_amount == '0' ) {
                $('#total').val('');
            } else {
                $('#total').text(total_amount);
            }
        });
        services.change(function(e) {
            paymentForm.attr("hidden",!services.is(":checked"));
            payNow.attr("disabled", !services.is(":checked"));

            if ( ! $(".service-checkbox:checked").length > 0 ) {
                $('#total').text(0);
            }
            var total = 0;
            $(".service-checkbox:checked").each(function() {
                total += parseFloat($(this).attr('data-price'));
                if ( total == '0' ) {
                    $('#total').val('');
                } else {
                    $('#total').text(total);
                }
            });
        });

        var $form = $("#registration-form");
        $.validator.addMethod("letters", function (value, element) {
            return this.optional(element) || value == value.match(/^[a-zA-Z\s]*$/);
        });

        var formValidator = $form.validate({
            errorClass: "inputError",
            onkeyup: false,
            onfocusout: false,
            rules: {
                first_name: {
                    required: true,
                    letters: true
                },
                last_name: {
                    required: true,
                    letters: true
                },
                email: {
                    required: true,
                    email: true
                },
                password: {
                    required: true,
                    minlength:6
                },
                password_confirmation: {
                    equalTo: "#password"
                },
                mobile_number: {
                    required: true,
                    phoneUS: true
                },
                birth_date: {
                    required: true,
                    date: true
                },
                'services[]': {
                    required: true,
                }
            },
            messages: {
                first_name: {
                    required: "Please enter your first name",
                    letters : "Only letters are allowed"
                },
                last_name: {
                    required: "Please enter your last name",
                    letters : "Only letters are allowed"
                },
                email: "Please provide a valid email address",
                password: {
                    required: "Please enter password",
                    minlength: jQuery.validator.format("Enter at least {0} characters")
                },
                mobile_number: {
                    required: "Please enter your phone number",
                    phoneUS: "Please enter valid phone number"
                },
                birth_date: "Please select birth date",
                address_line_1: " Please provide your address",
                city: "Please provide city",
                state: "Please provide state",
                country: "Please provide country",
                postal_code: "Please provide postal code",
                'services[]': {
                    required: "Please select service",
                }
            },
            submitHandler: function (form) {
                stripe.createToken(card).then(function(result) {
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

                                var first_name = $('#first-name').val();
                                var last_name  = $('#last-name').val();
                                var name       = first_name+' '+last_name;
                                var email      = $('#email').val();

                                var data = $('form#registration-form').serialize();
                                $.ajax({
                                    url: "{{ route('register') }}",
                                    method: 'POST',
                                    data: data,
                                    dataType: 'json',
                                    success: function(result) {
                                        if ( result.status == 'success' ) {
                                            $form.trigger("reset");
                                            card.clear();
                                            Swal.fire({
                                                type: 'success',
                                                title: 'Success',
                                                text: result.msg,
                                                allowOutsideClick: false,
                                                allowEscapeKey: false,
                                            }).then((result) => {
                                                if (result.value) {
                                                    window.location.href = "{{ route('login') }}";
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
                                        } else if( result.status == 'error' ) {
                                            // Store the failed payment response to db
                                            $('#stripeToken').val('');
                                            storeTransactionLog(name, email, result.msg, 'Registration Page');
                                            showAlert('error', result.msg);
                                        }
                                    },
                                    error: function (jqXHR, exception) {
                                        var msg = getErrorMsg(jqXHR, exception);
                                        console.log('Ajax error:'+ msg);
                                        $form.trigger("reset");
                                        paymentForm.attr('hidden','');

                                        // Store the failed payment response to db
                                        storeTransactionLog(name, email, msg, 'Registration Page');

                                        card.clear();
                                        $('#stripeToken').val('');
                                        showAlert('error', result.msg);
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


</script>
@endsection
