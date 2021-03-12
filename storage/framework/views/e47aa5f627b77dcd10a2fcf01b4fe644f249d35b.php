<tr>
    <td>
        <table class="email-footer" align="center" width="570" cellpadding="0" cellspacing="0" role="presentation">
            <tr>
                <td class="content-cell"
                    style="padding-top: 20px; border-top: 1px solid #ddd;" align="left">
                    <p class="f-fallback sub">
                        <a href="https://securtac.ca"
                            class="f-fallback email-masthead_name">
                            <?php echo e(Illuminate\Mail\Markdown::parse($site_logo)); ?>

                        </a>
                    </p>
                    <p style="font-size: 14px; margin-bottom: 5px;">
                        <?php echo $slot; ?>

                    </p>
                    <p>
                        <a href="https://www.facebook.com/SecurtacProtectionServices" style="text-decoration: none; margin-right: 5px;">
                            <?php echo e(Illuminate\Mail\Markdown::parse($facebook_img)); ?>

                        </a>
                        <a href="https://www.instagram.com/securtacprotectionservices" style="text-decoration: none;">
                            <?php echo e(Illuminate\Mail\Markdown::parse($instagram_img)); ?>

                        </a>
                    </p>
                </td>
            </tr>
        </table>
    </td>
</tr>
<?php /**PATH /home2/securtac/public_html/securtac/resources/views/vendor/mail/html/sign.blade.php ENDPATH**/ ?>