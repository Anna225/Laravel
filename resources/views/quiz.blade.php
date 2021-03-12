@extends('layouts.app')

@section('header_scripts')
@endsection

@section('content')
<div class="insite-content no-select">
    <div>
        <div class="bread-top">
            <div class="container">
                <div class="sec-title disflexc">
                    <h1>{{ ($is_final) ? "Final Quiz" : $chapter->name.'- Quiz' }}</h1>
                    <h5 class="ml-auto fw-700 disflexc">
                        <i class="icon-chronometer mr-2 fs-28"></i>
                        <span id="timer">00:00</span>
                    </h5>
                </div>
            </div>
        </div>
        <div class="container pt-4 question-wrapper">
            @if ($result)
                <div class="alert alert-success" role="alert">
                    <h4 class="alert-heading">Completed!</h4>
                    <p>It seems you have already completed this Quiz. Here is the result.</p>
                    <hr>
                    <p>Marks: <strong>{{ $result['correct_answers'] }}</strong>/<strong>{{ $result['total_questions'] }}</strong></p>
                    <p>Result:&nbsp;
                        <span class="badge 
                            @if( $result['result_status'] == "passed" ) 
                                badge-success
                            @else
                                badge-danger
                            @endif">{{ $result['result_status'] }}</span></p>
                    <p>Percentage: <strong>{{ $result['percentage'] }}</strong></p>
                    <p>Time Spent:<strong class="result_time_spent" data-sec="{{ $result['time_spent'] }}"></strong></p>
                </div>
                <br>
                {!!  html_entity_decode($result['result_data']) !!}
                <a class="btn btn-primary" href="{{ route('user.dashboard') }}">Go to Dashboard</a>
                <br><br>
            @else
                <div class="mt-60 btn-action">
                    <button class="btn btn-primary mw130 mb-3 start-quiz" data-type="{{ ($is_final) ? 'final' : 'regular' }}">Start
                        <i class="icon-arrow-right ml-2"></i>
                    </button>
                </div>
            @endif
            
        </div>
    </div>
</div>
<div class="result-copy" style="display:none;">
    <div class="result-wrapper">
        <div class="alert alert-success" role="alert">
            <h4 class="alert-heading">Result</h4>
            <p>Congratulations! You have completed this quiz.</p>
            <hr>
            <p>Marks: <strong class="correct_answers"></strong>/<strong class="total_questions"></strong></p>
            <p>Result: <span class="badge final-result"></span></p>
            <p>Percentage: <strong class="percentage"></strong></p>
            <p>Time Spent:<strong class="time-spent"></strong></p>
        </div>
        <a class="btn btn-primary" href="{{ route('user.dashboard') }}">Go to Dashboard</a>
        <br><br>
    </div>
</div>
<div class="question-copy" style="display:none;">
    <div class="chap-question">
        <h5 class="disflex">
            <dt class="mr-1 que-index"></dt>
            <dd class="mb-0 que-title"></dd>
        </h5>

        <div class="que-options">
            <form method="POST" action="" class='question-form'>
                <p>
                    <input type="radio" class="option-1" id="option1" name="options" value="" required>
                    <label for="option1">
                        <span class="mr-2">A)</span>
                        <span class="option_1"></span>
                    </label>
                </p>
                <p>
                    <input type="radio" class="option-2" id="option2" name="options" value="" required>
                    <label for="option2">
                        <span class="mr-2">B)</span>
                        <span class="option_2"></span>
                    </label>
                </p>
                <p>
                    <input type="radio" class="option-3" id="option3" name="options" value="" required>
                    <label for="option3">
                        <span class="mr-2">C)</span>
                        <span class="option_3"></span>
                    </label>
                </p>
                <p>
                    <input type="radio" class="option-4" id="option4" name="options" value="" required>
                    <label for="option4">
                        <span class="mr-2">D)</span>
                        <span class="option_4"></span>
                    </label>
                </p>
            </form>
        </div>
    </div>
    <div class="mt-10 btn-action">
        <p id="question-error" class="error" for="options" style="color:red"></p>
        <button type="submit" class="btn btn-primary mw130 mb-3 btn-nav" data-index="" data-question="" data-quiz="">Next
            <i class="icon-arrow-right ml-2"></i>
        </button>
    </div>
</div>
@endsection

@section('footer_scripts')
<script src="{{ asset('plugins/Minimal-Stopwatch/timer.jquery.min.js') }}"></script>
<script src="{{ asset('plugins/jquery-validation/jquery.validate.min.js') }}" ></script>
<script src="{{ asset('plugins/jquery-validation/additional-methods.min.js') }}"></script>
<script>    
$(document).ready(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    
    @if($result)
        var result_time_spent = $('.result_time_spent').attr('data-sec');
        $('.result_time_spent').text( ' '+secondsToPrettyTime(result_time_spent) );
    @endif
    //window.onbeforeunload = function() { return "Quiz is not completed yet."; };

    var quizTimer;
    var chapter_id   = {{ ($chapter) ? $chapter->id : 'null' }}
    var is_final     = {{ $is_final }}
    var validateForm = {
                            rules: {
                                options: {
                                    required: true
                                }
                            },
                            messages :{
                                options: "Please select one option",
                            },
                            errorPlacement: function(error, element) {
                                error.appendTo('#question-error');
                            },
                            success: function(label,element) {
                                $('#question-error').html('');
                            },
                            submitHandler: function (form) {
                                return true;
                            }
    };

    $('.question-wrapper').on('click', '.start-quiz', function(){
        //$('#question-block').addClass('loading-data');
        //$('.loader').show();
        var data = {chapter_id: chapter_id, is_final: is_final};
        $.ajax({
            url: "{{ route('quiz.initialize') }}",
            method: 'POST',
            data: data,
            cache: false,
            success: function(result){
                //console.log(result);
                if ( result.status == 'success' ) {

                    $.ajax({
                        url: "{{ route('start.quiz') }}",
                        method: 'POST',
                        data: data,
                        cache: false,
                        success: function(result){
                            //console.log(result);
                            if ( result.status == 'success' ) {
                                //console.log('got success response');
                                $("#timer").timer({ 
                                    action: 'start' 
                                });

                                $('.question-copy').find('.que-title').text(result.data.question);
                                $('.question-copy').find('.que-index').text('Q1');
                                $.each(result.data.options, function (key, val) {
                                    key++;
                                    $('.question-copy').find('.option_'+key).text(val.option);
                                    $('.question-copy').find('.option-'+key).val(val.id);
                                });

                                var navButton = $('.question-copy').find('.btn-nav');
                                navButton.attr('data-quiz', result.quiz );
                                navButton.attr('data-question', result.data.id );
                                navButton.attr('data-index', result.next );
                                navButton.text('Next');

                                $('.question-wrapper').fadeOut('slow', function() {
                                    var question_html = $(".question-copy").html();
                                    $('.question-wrapper').html(question_html);
                                    $('.question-wrapper').fadeIn('slow');
                                    $('.question-wrapper form.question-form').validate(validateForm);
                                });

                                // Update timer
                                updateTimer(result.quiz);

                            } else {
                                Swal.fire({
                                    type: 'error',
                                    title: 'Error',
                                    text: result.msg,
                                })
                                //$('#question-block').html(result.content);
                                console.log('no success response');
                            }
                        }
                    });
                } else {
                    Swal.fire({
                        type: 'error',
                        title: 'Error',
                        text: result.msg,
                        allowOutsideClick: false,
                        allowEscapeKey: false,
                    }).then((result) => {
                        if (result.value) {
                            location.reload(true);
                        }
                    });
                    
                }
            }
        });
    });

    $('.question-wrapper').on('click', '.btn-nav', function(){
        if ( ! $('.question-wrapper form.question-form').valid() ) {
            return;
        }

        var next     = $(this).attr('data-index');
        var question = $(this).attr('data-question');
        var quiz     = $(this).attr('data-quiz');
        var answer   = $(".question-wrapper form.question-form").serialize();
        var data     = { question: question, quiz: quiz, next: next, answer: answer, is_final: is_final };

        $.ajax({
            url: "{{ route('load.question') }}",
            method: 'POST',
            data: data,
            cache: false,
            success: function(result){
                //console.log(result);
                if ( result.status == 'success' ) {
                    //console.log('got success response');

                    $('.question-copy').find('.que-title').text(result.data.question);
                    var que_index = parseInt(next)+1;
                    $('.question-copy').find('.que-index').text('Q'+que_index);
                    $.each(result.data.options, function (key, val) {
                        key++;
                        $('.question-copy').find('.option_'+key).text(val.option);
                        $('.question-copy').find('.option-'+key).val(val.id);
                    });

                    var navButton = $('.question-copy').find('.btn-nav');
                    navButton.attr('data-quiz', result.quiz );
                    navButton.attr('data-question', result.data.id );
                    if ( result.next !== 'last' ) {
                        navButton.attr('data-index', result.next );
                        navButton.text('Next');
                    } else { // If question is last
                        navButton.attr('data-index', result.next );
                        navButton.text('Finish');
                        navButton.addClass('btn-finish');
                        navButton.removeClass('btn-nav');
                    }

                    $('.question-wrapper').fadeOut('slow', function() {
                        var question_html = $(".question-copy").html();
                        $('.question-wrapper').html(question_html);
                        $('.question-wrapper').fadeIn('slow');
                        $('.question-wrapper form.question-form').validate(validateForm);
                    });
                    
                } else {
                    console.log(result);
                }
            }
        });
    });

    $('.question-wrapper').on('click', '.btn-finish', function(){
        Swal.fire({
            title: 'Loading...',
            text:'Generating your quiz result.',
            showConfirmButton: false,
            allowOutsideClick: false,
            allowEscapeKey: false,
            allowEnterKey:false,
            onBeforeOpen: () => {
                Swal.showLoading()
                
                $("#timer").timer('pause'); // pause the timer
                var latest_time = $("#timer").data('seconds');
                clearTimeout(quizTimer); // stop the timer update to database

                var question = $(this).attr('data-question');
                var quiz     = $(this).attr('data-quiz');
                var answer   = $(".question-wrapper form.question-form").serialize();
                var data     = {question: question, quiz: quiz, answer: answer, latest_time: latest_time, chapter_id: chapter_id, is_final: is_final};

                $.ajax({
                    url: "{{ route('finish.quiz') }}",
                    method: 'POST',
                    data: data,
                    cache: false,
                    success: function(result){
                        //console.log(result);
                        var correct_answers = result.correct;
                        var total_que       = result.total;
                        var time_spent      = secondsToPrettyTime(result.time_spent);
                        var percentage      = result.percentage;
                        var result_status   = result.result_status;

                        //$('.result').text(correct_answers+' of '+total_que);
                        $('.correct_answers').text(correct_answers);
                        $('.total_questions').text(total_que);
                        $('.percentage').text(percentage);
                        $('.time-spent').text(time_spent);

                        // Change badge class based on result
                        if ( result_status == 'Passed' ) {
                            $('.final-result').addClass('badge-success');
                        } else {
                            $('.final-result').addClass('badge-danger');
                        }
                        $('.final-result').text(result_status);

                        $('.question-wrapper').fadeOut('slow', function() {
                            var result_html = $(".result-copy").html();
                            $('.question-wrapper').html(result.result + result_html);
                            $('.question-wrapper').fadeIn('slow');
                            Swal.close();
                        });
                    }
                });
            }
        }).then((result) => {
            console.log('I was closed');
        })

        
    });

    function updateTimer(quiz_id){
        var current_time = $("#timer").data('seconds');
        var data         = { quiz_id: quiz_id, current_time: current_time };
        $.ajax({
            url: "{{ route('quiz.timer') }}",
            method: 'POST',
            data: data,
            cache: false,
            success: function(result){
                quizTimer = setTimeout( updateTimer, 5000, result.quiz_id);
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

</script>
@endsection
