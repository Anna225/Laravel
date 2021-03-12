@extends('layouts.app')

@section('header_scripts')

@endsection

@section('content')
<div class="insite-content">

    <div class="site-part schedule-page">
        <div class="container">
            <div class="sec-title disflexc">
                <h1>{{ $chapter->name }}</h1>
                <h5 class="ml-auto fw-700 disflexc nowrap">
                    <i class="icon-chronometer mr-2 fs-28"></i>
                    <span id="timer"></span>
                </h5>
            </div>

            <div class="mt-30" id="slide-content">
                <button class="btn btn-primary start-study">{{ $log->action_btn }}</button>
                <div class="loader"></div>
            </div>

            <div class="mt-30 text-right slide-navigator">
                <button class="btn btn-primary mw130 mb-3 slide-nav prev-slide" data-slide="none" style="display:none;" type="submit" ><i class="icon-arrow-left ml-2"></i> Prev</button>
                <button class="btn btn-primary mw130 mb-3 slide-nav next-slide" data-slide="none" style="display:none;" type="submit">Next <i class="icon-arrow-right ml-2"></i></button>
                <button class="btn btn-primary mw130 mb-3 finish-slide" style="display:none;" type="submit">Finish</button>
            </div>
        </div>
    </div>

</div>
@endsection

@section('footer_scripts')
<script src="{{ asset('plugins/Minimal-Stopwatch/timer.jquery.min.js') }}"></script>
<script>
    var timeoutID;
    $(document).ready(function(){
        var startTimer,log_id;
        var chapter_id   = '{{ $chapter->id }}';
        var study_time   = '{{ $chapter->study_time }}';
        var last_log     = '{{ $log->last_time_log }}';
        var last_slide   = '{{ $log->last_slide }}';
        var user_id      = '{{ $user->id }}';
        var is_finished  = '{{ $log->is_finished }}';
        var total_slides = '{{ $chapter->slides_count }}';

        //var log_id       = '{{ $chapter->log_id }}';

        // window.onblur = function() {
        //     $("#timer").timer('pause');
        // };

        window.onfocus = function() {
            $("#timer").timer('resume');
        };

        $('#timer').text( secondsToPrettyTime( last_log ));

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#slide-content').on('click', '.start-study', function(){
            //$('#slide-content').addClass('loading-data');
            //$('.loader').show();
            var data = {chapter: chapter_id, last_slide: last_slide, last_log: last_log, total_slides:total_slides, is_finished:is_finished };

            $.ajax({
                url: "{{ route('load_slides') }}",
                method: 'POST',
                data: data,
                cache: false,
                success: function(result){
                    //console.log(result);
                    if ( result.status == 'success' ) {
                        //$('#slide-content').removeClass('loading-data');
                        //$('.loader').hide();

                        // Start the timer
                        if ( result.is_finished == '0' ) {
                            if ( $('#timer').data('state') == 'paused' ) {
                                $("#timer").timer('resume');
                            } else {
                                $("#timer").timer({
                                    action: 'start',
                                    seconds: last_log
                                });
                            }
                        }

                        // Update the global variables
                        log_id      = result.log_id;
                        is_finished = result.is_finished;

                        // Add last visited slide to first slide
                        localStorage.setItem('last_slide_visited-'+chapter_id+'-'+user_id, result.current_slide);

                        // Set update timer
                        updateTimer(log_id);

                        // Start the inactivity timer
                        setup();

                        $('#slide-content').fadeOut('slow', function() {
                            $('#slide-content').html(result.content);
                            $('#slide-content').fadeIn('slow');

                            if ( result.next_slide == 'finish' ) { //If it's last slide
                                $('.next-slide').hide();
                                $('.finish-slide').attr('data-log_id', result.log_id);
                                $('.finish-slide').show();
                            } else {
                                $('.next-slide').attr('data-slide', result.next_slide);
                                $('.next-slide').show();
                                $('.finish-slide').hide();
                            }

                            // Previous button
                            if ( result.prev_slide !== 'none' ) {
                                $('.prev-slide').attr('data-slide', result.prev_slide );
                                $('.prev-slide').show();
                            } else {
                                $('.prev-slide').hide();
                            }
                        });
                    } else {
                        $('#slide-content').html(result.content);
                    }
                }
            });
        });

        $('.slide-navigator').on('click', '.slide-nav', function (){
            var slideNo = $(this).attr('data-slide');
            var data    = {chapter: chapter_id, slide: slideNo, total_slides: total_slides, is_finished: is_finished};

            $.ajax({
                url: "{{ route('load_slides') }}",
                method: 'POST',
                data: data,
                cache: false,
                success: function(result){
                    if ( result.status == 'success' ) {
                        //$('#slide-content').removeClass('loading-data');
                        //$('.loader').hide();

                        $('#slide-content').fadeOut('slow', function() {
                            $('#slide-content').html(result.content);
                            $('#slide-content').fadeIn('slow');

                            // Update the last slide in local storage
                            localStorage.setItem('last_slide_visited-'+chapter_id+'-'+user_id, slideNo);

                            if ( result.next_slide == 'finish' ) { //If it's last slide
                                $('.next-slide').hide();
                                $('.finish-slide').attr('data-log_id', result.log_id);
                                $('.finish-slide').show();
                            } else {
                                $('.next-slide').show();
                                $('.finish-slide').hide();
                                $('.next-slide').attr('data-slide', result.next_slide);
                            }

                            // Previous button
                            if ( result.prev_slide !== 'none' ) {
                                $('.prev-slide').attr('data-slide', result.prev_slide );
                                $('.prev-slide').show();
                            } else {
                                $('.prev-slide').hide();
                            }
                        });
                    }
                }
            });
        });

        $('.slide-navigator').on('click', '.finish-slide', function (){
            // check current study time
            if ( $("#timer").data('seconds') < study_time  ) {
                Swal.fire({
                    type: 'warning',
                    text: `You need to study at least ${ secondsToPrettyTime( study_time ) }`,
                })
            } else {
                swal.fire({
                    title: 'Are you sure want to finish study?',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes',
                    cancelButtonText: 'Cancel',
                }).then((result) => {
                    if (result.value) {
                        // Finish the current chapter
                        var data = {log_id: log_id};

                        $.ajax({
                            url: "{{ route('finish_study') }}",
                            method: 'POST',
                            data: data,
                            cache: false,
                            success: function(result){
                                if ( result.status == 'success' ) {
                                    // Stop the timer
                                    $("#timer").timer('pause');

                                    clearTimeout(startTimer);

                                    // Stop the inactivity timer
                                    stopInactivityTimer();

                                    $('#slide-content').html('<button class="btn btn-primary start-study">Start Study</button>');
                                    is_finished = '1';
                                    $(this).hide(); //hide finish button
                                    $('.next-slide').hide();
                                    $('.prev-slide').hide();
                                    $('.finish-slide').hide();
                                }
                            },
                            error: function (jqXHR, exception) {
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
                                console.log('Ajax error:'+ msg);
                            }
                        });
                    }
                })
            }
            
        });

        function updateTimer(log_id){
            var newTime            = $("#timer").data('seconds');
            var last_visited_slide = localStorage.getItem('last_slide_visited-'+chapter_id+'-'+user_id);
            var data               = { log_id: log_id, current_time: newTime, last_slide: last_visited_slide };
            $.ajax({
                url: "{{ route('update_timer') }}",
                method: 'POST',
                data: data,
                cache: false,
                success: function(result){
                    //var newTime = $("#timer").data('seconds');
                    startTimer = setTimeout( updateTimer, 5000, result.log_id);
                },
                error: function (jqXHR, exception) {
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
                    console.log('Ajax error:'+ msg);
                },
            });
        }
    });

    function setup() {
        this.addEventListener("mousemove", resetTimer, false);
        this.addEventListener("mousedown", resetTimer, false);
        this.addEventListener("keypress", resetTimer, false);
        this.addEventListener("DOMMouseScroll", resetTimer, false);
        this.addEventListener("mousewheel", resetTimer, false);
        this.addEventListener("touchmove", resetTimer, false);
        this.addEventListener("MSPointerMove", resetTimer, false);
    
        startInactivityTimer();
    }

    function startInactivityTimer() {
        let time = 120;//sec
        timeoutID = window.setTimeout(goInactive, time*1000 );
    }

    function resetTimer(e) {
        window.clearTimeout(timeoutID);

        goActive();
    }

    function goInactive() {
        // do something
        $("#timer").timer('pause');
    }
    
    function goActive() {
        // do something
        $("#timer").timer('resume');

        startInactivityTimer();
    }

    function stopInactivityTimer(){
        this.removeEventListener("mousemove", justClear, false);
        this.removeEventListener("mousedown", justClear, false);
        this.removeEventListener("keypress", justClear, false);
        this.removeEventListener("DOMMouseScroll", justClear, false);
        this.removeEventListener("mousewheel", justClear, false);
        this.removeEventListener("touchmove", justClear, false);
        this.removeEventListener("MSPointerMove", justClear, false);
    }

    function justClear(){
        window.clearTimeout(timeoutID);
    }
</script>
@endsection
