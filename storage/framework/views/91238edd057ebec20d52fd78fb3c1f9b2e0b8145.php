<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="x-apple-disable-message-reformatting" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title></title>
    <style type="text/css" rel="stylesheet" media="all">
        /* Base ------------------------------ */

        @import  url("https://fonts.googleapis.com/css?family=Nunito+Sans:400,700&display=swap");

        body {
            width: 100% !important;
            height: 100%;
            margin: 0;
            -webkit-text-size-adjust: none;
        }

        a {
            color: #3869D4;
        }

        a img {
            border: none;
        }

        td {
            word-break: break-word;
        }

        .preheader {
            display: none !important;
            visibility: hidden;
            mso-hide: all;
            font-size: 1px;
            line-height: 1px;
            max-height: 0;
            max-width: 0;
            opacity: 0;
            overflow: hidden;
        }

        /* Type ------------------------------ */

        body,
        td,
        th {
            font-family: "Nunito Sans", Helvetica, Arial, sans-serif;
        }

        h1 {
            margin-top: 0;
            color: #333333;
            font-size: 22px;
            font-weight: bold;
            text-align: left;
        }

        h2 {
            margin-top: 0;
            color: #333333;
            font-size: 16px;
            font-weight: bold;
            text-align: left;
        }

        h3 {
            margin-top: 0;
            color: #333333;
            font-size: 14px;
            font-weight: bold;
            text-align: left;
        }

        h4 {
            display: block;
            margin-top: 20px;
            margin-bottom: 20px;
            font-weight: bold;
        }

        h5 {
            display: block;
            font-size: 16px;
            margin-top: 25px;
            margin-bottom: 10px;
            font-weight: bold;
        }

        td,
        th {
            font-size: 16px;
        }

        p,
        ul,
        ol,
        blockquote {
            margin: .4em 0 1.1875em;
            font-size: 16px;
            line-height: 1.625;
        }

        p.sub {
            font-size: 13px;
        }

        /* Utilities ------------------------------ */

        .align-right {
            text-align: right;
        }

        .align-left {
            text-align: left;
        }

        .align-center {
            text-align: center;
        }

        /* Buttons ------------------------------ */

        .button {
            background-color: #3869D4;
            border-top: 10px solid #3869D4;
            border-right: 18px solid #3869D4;
            border-bottom: 10px solid #3869D4;
            border-left: 18px solid #3869D4;
            display: inline-block;
            color: #FFF;
            text-decoration: none;
            border-radius: 3px;
            box-shadow: 0 2px 3px rgba(0, 0, 0, 0.16);
            -webkit-text-size-adjust: none;
            box-sizing: border-box;
        }

        .button--green {
            background-color: #22BC66;
            border-top: 10px solid #22BC66;
            border-right: 18px solid #22BC66;
            border-bottom: 10px solid #22BC66;
            border-left: 18px solid #22BC66;
        }

        .button--red {
            background-color: #FF6136;
            border-top: 10px solid #FF6136;
            border-right: 18px solid #FF6136;
            border-bottom: 10px solid #FF6136;
            border-left: 18px solid #FF6136;
        }

        @media  only screen and (max-width: 500px) {
            .button {
                width: 100% !important;
                text-align: center !important;
            }
        }

        /* Attribute list ------------------------------ */

        .attributes {
            margin: 0 0 21px;
        }

        .attributes_content {
            background-color: #F4F4F7;
            padding: 16px;
        }

        .attributes_item {
            padding: 0;
        }

        /* Related Items ------------------------------ */

        .related {
            width: 100%;
            margin: 0;
            padding: 25px 0 0 0;
            -premailer-width: 100%;
            -premailer-cellpadding: 0;
            -premailer-cellspacing: 0;
        }

        .related_item {
            padding: 10px 0;
            color: #CBCCCF;
            font-size: 15px;
            line-height: 18px;
        }

        .related_item-title {
            display: block;
            margin: .5em 0 0;
        }

        .related_item-thumb {
            display: block;
            padding-bottom: 10px;
        }

        .related_heading {
            border-top: 1px solid #CBCCCF;
            text-align: center;
            padding: 25px 0 10px;
        }

        /* Discount Code ------------------------------ */

        .discount {
            width: 100%;
            margin: 0;
            padding: 24px;
            -premailer-width: 100%;
            -premailer-cellpadding: 0;
            -premailer-cellspacing: 0;
            background-color: #F4F4F7;
            border: 2px dashed #CBCCCF;
        }

        .discount_heading {
            text-align: center;
        }

        .discount_body {
            text-align: center;
            font-size: 15px;
        }

        /* Social Icons ------------------------------ */

        .social {
            width: auto;
        }

        .social td {
            padding: 0;
            width: auto;
        }

        .social_icon {
            height: 20px;
            margin: 0 8px 10px 8px;
            padding: 0;
        }

        /* Data table ------------------------------ */

        .purchase {
            width: 100%;
            margin: 0;
            padding: 35px 0;
            -premailer-width: 100%;
            -premailer-cellpadding: 0;
            -premailer-cellspacing: 0;
        }

        .purchase_content {
            width: 100%;
            margin: 0;
            padding: 25px 0 0 0;
            -premailer-width: 100%;
            -premailer-cellpadding: 0;
            -premailer-cellspacing: 0;
        }

        .purchase_item {
            padding: 10px 0;
            color: #51545E;
            font-size: 15px;
            line-height: 18px;
        }

        .purchase_heading {
            padding-bottom: 8px;
            border-bottom: 1px solid #EAEAEC;
        }

        .purchase_heading p {
            margin: 0;
            color: #85878E;
            font-size: 12px;
        }

        .purchase_footer {
            padding-top: 15px;
            border-top: 1px solid #EAEAEC;
        }

        .purchase_total {
            margin: 0;
            text-align: right;
            font-weight: bold;
            color: #333333;
        }

        .purchase_total--label {
            padding: 0 15px 0 0;
        }

        body {
            background-color: #F2F4F6;
            color: #51545E;
        }

        p {
            color: #51545E;
        }

        .email-wrapper {
            width: 100%;
            margin: 0;
            padding: 0;
            -premailer-width: 100%;
            -premailer-cellpadding: 0;
            -premailer-cellspacing: 0;
            background-color: #F2F4F6;
        }

        .email-content {
            width: 100%;
            margin: 0;
            padding: 0;
            -premailer-width: 100%;
            -premailer-cellpadding: 0;
            -premailer-cellspacing: 0;
        }

        /* Masthead ----------------------- */

        .email-masthead {
            padding: 25px 0;
            text-align: center;
        }

        .email-masthead_logo {
            width: 94px;
        }

        .email-masthead_name {
            font-size: 16px;
            font-weight: bold;
            color: #A8AAAF;
            text-decoration: none;
            text-shadow: 0 1px 0 white;
        }

        /* Body ------------------------------ */

        .email-body {
            width: 100%;
            margin: 0;
            padding: 0;
            -premailer-width: 100%;
            -premailer-cellpadding: 0;
            -premailer-cellspacing: 0;
        }

        .email-body_inner {
            width: 570px;
            margin: 0 auto;
            padding: 0;
            -premailer-width: 570px;
            -premailer-cellpadding: 0;
            -premailer-cellspacing: 0;
            background-color: #FFFFFF;
        }

        .email-footer {
            width: 570px;
            margin: 0 auto;
            padding: 0;
            -premailer-width: 570px;
            -premailer-cellpadding: 0;
            -premailer-cellspacing: 0;
            text-align: center;
        }

        .email-footer p {
            color: #A8AAAF;
        }

        .body-action {
            width: 100%;
            margin: 10px auto;
            padding: 0;
            -premailer-width: 100%;
            -premailer-cellpadding: 0;
            -premailer-cellspacing: 0;
            text-align: center;
        }

        .body-sub {
            margin-top: 25px;
            padding-top: 25px;
            border-top: 1px solid #EAEAEC;
        }

        .content-cell {
            padding: 45px;
        }

        /*Media Queries ------------------------------ */

        @media  only screen and (max-width: 600px) {

            .email-body_inner,
            .email-footer {
                width: 100% !important;
            }
        }

        @media (prefers-color-scheme: dark) {

            body,
            .email-body,
            .email-body_inner,
            .email-content,
            .email-wrapper,
            .email-masthead,
            .email-footer {
                background-color: #333333 !important;
                color: #FFF !important;
            }

            p,
            ul,
            ol,
            blockquote,
            h1,
            h2,
            h3 {
                color: #FFF !important;
            }

            .attributes_content,
            .discount {
                background-color: #222 !important;
            }

            .email-masthead_name {
                text-shadow: none !important;
            }
        }
    </style>
    <!--[if mso]>
    <style type="text/css">
      .f-fallback  {
        font-family: Arial, sans-serif;
      }
    </style>
  <![endif]-->
</head>

<body>
    <table class="email-wrapper" width="100%" cellpadding="0" cellspacing="0" role="presentation">
        <tr>
            <td align="center">
                <table class="email-content" width="100%" cellpadding="0" cellspacing="0" role="presentation">
                    <tr>
                        <td class="email-masthead">
                            <a href="https://securtac.ca" class="f-fallback email-masthead_name">
                                <img src="<?php echo e(asset('images/email_site-logo.png')); ?>" width="75">
                            </a>
                        </td>
                    </tr>
                    <!-- Email Body -->
                    <tr>
                        <td class="email-body" width="570" cellpadding="0" cellspacing="0">
                            <table class="email-body_inner" align="center" width="570" cellpadding="0" cellspacing="0"
                                role="presentation">
                                <!-- Body content -->
                                <tr>
                                    <td class="content-cell" style="padding-bottom: 0px;">
                                        <div class="f-fallback">
                                            <h1>Hello there!</h1>
                                            <h4>Securtac Protection Services Inc. would like to sincerely thank you for
                                                choosing us for your
                                                training needs. Please read the information below and keep it for future
                                                reference.</h4>
                                            <div style="margin-top: 20px;">
                                                <h5 style="font-size: 16px; color: black;">1. Online Security Guard
                                                    Training</h5>
                                                <p>
                                                    If you have signed up for our online e-learning security guard
                                                    training program, you have 6
                                                    months from the date of registration to complete the course. You can
                                                    complete the course at
                                                    your own convenience, whenever and wherever you wish, as long as you
                                                    have access to the
                                                    internet.
                                                    <br><br>
                                                    If for any reason you require assistance in understanding the course
                                                    material, there is a chat
                                                    function so that you can communicate with us and someone will
                                                    respond to you within regular
                                                    business hours Monday to Friday 9AM-5PM. Any messages we receive
                                                    after hours will be responded
                                                    to in priority sequence the next business day. You may also call our
                                                    head office within
                                                    regular business hours.

                                                </p>
                                            </div>

                                            <div style="margin-top: 20px;">
                                                <h5 style="font-size: 16px; color: black;">2. FIRST AID CPR WITH AED
                                                    LEVEL C</h5>
                                                <p>
                                                    If you have registered and signed up for our First Aid CPR with AED
                                                    course, please ensure you have selected a date that is convenient
                                                    for you. Please arrive on time and dress comfortably. If you are
                                                    more than 10 minutes late and the class has started, you will not be 
                                                    allowed to attend the training session and will have to re-book the
                                                    class with an additional fee. Please refer to our refund policy at
                                                    elearning.securtac.ca. We hope that you enjoy our training programs.
                                                    Feel free to contact us should you have any questions or concerns at
                                                    416-479-0056 or email us at <a
                                                        href="mailto:info@securtac.ca">info@securtac.ca</a>.
                                                    <br><br>
                                                    Oh, and one more thing do you like receiving free stuff?
                                                    When you are logged into our e-learning platform, scroll to the top
                                                    or bottom of the page, where you will find a refer a friend button.
                                                    For each friend you refer that signs up with our e-learning courses,
                                                    we will provide you with a free gift card. It’s that simple.
                                                    <br><br>
                                                    Don't forget to follow us and get social.


                                                </p>
                                            </div>
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        <table class="email-footer" align="center" width="570" cellpadding="0"
                                            cellspacing="0" role="presentation">
                                            <tr>
                                                <td class="content-cell"
                                                    style="padding-top: 20px; border-top: 1px solid #ddd;" align="left">
                                                    <p class="f-fallback sub">
                                                        <a href="https://securtac.ca"
                                                            class="f-fallback email-masthead_name">
                                                            <img src="<?php echo e(asset('images/email_site-logo.png')); ?>" width="50">
                                                        </a>
                                                    </p>
                                                    <p style="font-size: 14px; margin-bottom: 5px;">
                                                        1691 McCowan Rd. Unit 101 <br>
                                                        Toronto, Ontario <br>
                                                        M1S 2Y3 <br>
                                                        Tel: 416-479-0056<br>
                                                        <a href="https://securtac.ca">www.securtac.ca</a>
                                                    </p>
                                                    <p>
                                                        <a href="" style="text-decoration: none; margin-right: 5px;">
                                                            <img src="<?php echo e(asset('images/email_facebook.png')); ?>" width="24">
                                                        </a>
                                                        <a href="" style="text-decoration: none;">
                                                            <img src="<?php echo e(asset('images/email_instagram.png')); ?>" width="24">
                                                        </a>
                                                    </p>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    
                </table>
            </td>
        </tr>
    </table>
</body>

</html><?php /**PATH /home2/securtac/public_html/securtac/resources/views/emails/welcome.blade.php ENDPATH**/ ?>