$(function() {
    $('.btn-invite').click(function(e){
        e.preventDefault();
        var user_id = $(this).attr('data-user');

        Swal.fire({
        title: 'Send Invite',
        text: 'Invite Your Friends and Earn Gifts',
        input: 'email',
        inputPlaceholder: 'Enter email address',
        showCancelButton: true,
        confirmButtonText: 'Send',
        showLoaderOnConfirm: true,
        preConfirm: (email) => {
            var headers = {
                "Content-Type": "application/json",
                "Access-Control-Origin": "*",
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
            return fetch('refer/send',{
                method: "POST",
                headers: headers,
                body: JSON.stringify({ email: `${email}` })
            })
            .then(response => {
                if (!response.ok) {
                 throw new Error(response.statusText)
                }
                return response.json()
            })
            .catch(error => {
                Swal.showValidationMessage(
                `Request failed: ${error}`
                )
            })
        },
        allowOutsideClick: () => !Swal.isLoading()
        }).then((result) => {
            //console.log(result.value.status);
            if ( result.value.status == 'success' ) {
                Swal.fire({
                    type: 'success',
                    title: 'Success',
                    text: result.value.msg,
                }).then(function(){
                    window.location.reload();
                });
            } else if( result.value.status == 'error' ){
                Swal.fire({
                    type: 'error',
                    title: 'Error',
                    text: result.value.msg,
                })
            }
        });
    });
});

$(window).scroll(function () {
    var scroll = $(window).scrollTop();
    if (scroll >= 100) {
        $(".custom-nav").addClass("after-header");
    } else {
        $(".custom-nav").removeClass("after-header");
    }
});

function secondsToPrettyTime(t) {
    var e = s(t);
    return e.days ? e.days + ":" + r(e.hours) + ":" + r(e.minutes) + ":" + r(e.seconds) : e.hours ? e.hours + ":" + r(e.minutes) + ":" + r(e.seconds) : e.minutes ? e.minutes + ":" + r(e.seconds) + " min" : e.seconds + " sec"
}

function s(t) {
    var e;
    return t = t || 0, e = Math.floor(t / 60), {
        days: t >= 86400 ? Math.floor(t / 86400) : 0,
        hours: 3600 <= t ? Math.floor(t % 86400 / 3600) : 0,
        totalMinutes: e,
        minutes: 60 <= t ? Math.floor(t % 3600 / 60) : e,
        seconds: t % 60,
        totalSeconds: t
    }
}

function r(t) {
    return ((t = parseInt(t, 10)) < 10 && "0") + t
}

function showAlert(type, message) {
    var title =  type.charAt(0).toUpperCase() + type.slice(1);
    Swal.fire({
        type: type,
        title: title,
        text: message,
        allowOutsideClick: false,
        allowEscapeKey: false,
    });
}

function getErrorMsg(jqXHR, exception) {
    var msg = '';
    if (jqXHR.status === 0) {
        msg = 'Not connect.\n Verify Network.';
    } else if (jqXHR.status == 404) {
        msg = 'Requested page not found. [404]';
    } else if (jqXHR.status == 500) {
        msg = 'Internal Server Error [500].';
    } else if (exception === 'parsererror') {
        msg = 'Requested JSON parse failed.';
    } else if (exception === 'timeout') {
        msg = 'Time out error.';
    } else if (exception === 'abort') {
        msg = 'Ajax request aborted.';
    } else {
        if ( jqXHR.responseText ) {
            msg = 'Uncaught Error.\n' + jqXHR.responseText.message;
        } else {
            msg = 'Uncaught Error.\n' + jqXHR.responseText;
        }
    }
    return msg;
}

function storeTransactionLog(name=null, email=null, response, page) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    var payment_response = JSON.stringify(response);
    var data             = {name:name, email:email, page:page, payment_response:payment_response};
    $.ajax({
        url: "/register/failed",
        method: 'POST',
        data: data,
        dataType: 'json',
        success: function(result) {
            console.log(result);
        }
    });
}

