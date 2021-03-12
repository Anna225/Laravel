@extends('layouts.app')

@section('header_scripts')
@endsection

@section('content')
<div class="insite-content main-content">

    <div class="bread-top">
        <div class="container">
            <h3>Welcome {{ auth()->user()->name }},</h3>
        </div>
    </div>

    <div class="site-part">
        <div class="container">
            <div>
                <div class="sec-title">
                    <h1>Services</h1>
                </div>
                <div class="row mt-4">
                    @foreach ($services as $key => $service)
                        <div class="col-md-4 reveal">
                            <div class="service-plate">
                                <div class="service-top">
                                    <img src="{{ $service->image_url }}" width="100%">
                                </div>
                                <div class="service-desc">
                                    <h3>{{ $service->name }}</h3>

                                    @if ( $key == 0 )
                                        @if ( ! isSubscribed( $service->id ) )
                                            <h4 class="inside-cost">${{ $service->price_without_tax }}</h4>
                                            <div class="text-center">
                                                <a href="{{ route('subscribe', $service->id ) }}">
                                                    <button class="btn btn-primary no-mw"> Enroll Now
                                                        <i class="icon-arrow-right ml-2"></i>
                                                    </button>
                                                </a>
                                            </div>
                                        @elseif( isSubscribed( $service->id )->status == 'subscribed' )
                                            <h4 class="inside-cost">&nbsp;</h4>
                                            <div class="text-center">
                                                <a href="{{ route("training_chapters") }}">
                                                    <button class="btn btn-primary no-mw"> Study Now
                                                        <i class="icon-arrow-right ml-2"></i>
                                                    </button>
                                                </a>
                                            </div>
                                        @else
                                            <h4 class="inside-cost">${{ $service->price_without_tax }}</h4>
                                            <div class="text-center">
                                                <a href="{{ route('subscribe', $service->id ) }}">
                                                    <button class="btn btn-primary no-mw"> Renew Now
                                                        <i class="icon-arrow-right ml-2"></i>
                                                    </button>
                                                </a>
                                            </div>
                                        @endif

                                    @elseif( $key == 1 )
                                        @if ( ! isSubscribed( $service->id ) )
                                            <h4 class="inside-cost">${{ $service->price_without_tax }}</h4>
                                            <div class="text-center">
                                                <a href="{{ route('subscribe', $service->id ) }}">
                                                    <button class="btn btn-primary no-mw"> Enroll Now
                                                        <i class="icon-arrow-right ml-2"></i>
                                                    </button>
                                                </a>
                                            </div>
                                        @elseif( isSubscribed( $service->id )->status == 'subscribed' )
                                            <h4 class="inside-cost">&nbsp;</h4>
                                            <div class="text-center">
                                                <a href="{{ route("schedule", $service->id) }}">
                                                    <button class="btn btn-primary no-mw"> Schedule
                                                        <i class="icon-arrow-right ml-2"></i>
                                                    </button>
                                                </a>
                                            </div>
                                        @else
                                            <h4 class="inside-cost">${{ $service->price_without_tax }}</h4>
                                            <div class="text-center">
                                                <a href="{{ route('subscribe', $service->id ) }}">
                                                    <button class="btn btn-primary no-mw"> Renew Now
                                                        <i class="icon-arrow-right ml-2"></i>
                                                    </button>
                                                </a>
                                            </div>
                                        @endif

                                    @elseif( $key == 2 )
                                        @if ( ! isSubscribed( $service->id ) )
                                            <h4 class="inside-cost">${{ $service->price_without_tax }}</h4>
                                            <div class="text-center">
                                                <a href="{{ route('subscribe', $service->id ) }}">
                                                    <button class="btn btn-primary no-mw"> Enroll Now
                                                        <i class="icon-arrow-right ml-2"></i>
                                                    </button>
                                                </a>
                                            </div>
                                        @elseif( isSubscribed( $service->id )->status == 'subscribed' )
                                            <h4 class="inside-cost">&nbsp;</h4>
                                            <div class="text-center">
                                                <a href="{{ route("schedule", $service->id) }}">
                                                    <button class="btn btn-primary no-mw"> Schedule
                                                        <i class="icon-arrow-right ml-2"></i>
                                                    </button>
                                                </a>
                                            </div>
                                        @else
                                            <h4 class="inside-cost">${{ $service->price_without_tax }}</h4>
                                            <div class="text-center">
                                                <a href="{{ route('subscribe', $service->id ) }}">
                                                    <button class="btn btn-primary no-mw"> Renew Now
                                                        <i class="icon-arrow-right ml-2"></i>
                                                    </button>
                                                </a>
                                            </div>
                                        @endif
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="tra-process">
                <div class="sec-title">
                    <h1>Security Training Progress</h1>
                </div>

                <div class="table-responsive mt-4">
                    {{-- hardcoded service ID 1 for security training --}}
                    @if ( ! $securitySubscription )
                        <div class="alert alert-info" role="alert">
                            Please enroll to Security Training Syllabus service
                        </div>
                    @elseif( $securitySubscription->status == 'expired' )
                        <div class="alert alert-info" role="alert">
                            <h3 class="alert-heading">Expired</h3>
                            <p>Your service has been expired.Please renew your subscription in order to view the progress.</p>
                        </div>
                    @else
                        <table class="table">
                            <tbody>
                                @foreach ( $trainingChapters as $key => $chapter )
                                    <tr>
                                        <td class="max-wtd">{{ ($key + 1).'. '.$chapter->name }}</td>

                                        @if ( ! $chapter->quiz_reports->isEmpty() )
                                            <td class="disflexc">
                                                <div class="progress cus-progress">
                                                    <div class="progress-bar" style="width:{{ $chapter->quiz_reports->first()->percentage }}%"></div>
                                                </div>
                                                {{ $chapter->quiz_reports->last()->percentage }}%
                                            </td>
                                            <td class="mw-td"><b>{{ $chapter->quiz_reports->last()->total_correct }}</b>/ {{ $chapter->quiz_reports->last()->total_questions }}</td>
                                            <td class="text-center">
                                                <a href="{{ route('show_slides', $chapter->id) }}"><button class="btn btn-outline-danger btn-small">Study Now</button></a>
                                                &nbsp;
                                                <button class="btn btn-outline-primary btn-small" disabled>{{ ucfirst($chapter->quiz_reports->last()->result_status) }}</button>
                                                &nbsp;
                                                @if( $chapter->quiz_reports->last()->result_status == 'failed' )
                                                    <a href="{{ route('quiz', $chapter->id) }}"><button class="btn btn-outline-danger btn-small">Take Quiz</button></a>
                                                @elseif( $chapter->quiz_reports->last()->result_status == 'passed' )
                                                    <a href="{{ route('quiz', $chapter->id) }}"><button class="btn btn-outline-danger btn-small">Result</button></a>
                                                @endif
                                            </td>
                                        @elseif ( ! $chapter->study_log->isEmpty() )
                                            @if( $chapter->study_log->first()->is_finished )
                                                <td class="disflexc">
                                                    <div class="progress cus-progress">
                                                        <div class="progress-bar bg-danger" style="width:100%"></div>
                                                    </div>
                                                    100%
                                                </td>
                                                <td class="mw-td"><b>0</b>/0</td>
                                                <td class="text-center">
                                                    <a href="{{ route('show_slides', $chapter->id) }}"><button class="btn btn-outline-danger btn-small">Study Now</button></a>
                                                    &nbsp;
                                                    <a href="{{ route('quiz', $chapter->id) }}"><button class="btn btn-outline-danger btn-small">Take Quiz</button></a>
                                                </td>
                                            @elseif( isStudyAllowed( $chapter->id ) )
                                                <td class="disflexc">
                                                    <div class="progress cus-progress">
                                                        <div class="progress-bar bg-danger" style="width:{{ $chapter->study_log->first()->percentage }}%"></div>
                                                    </div>
                                                    {{ $chapter->study_log->first()->percentage }}%
                                                </td>
                                                <td class="mw-td"><b>0</b>/0</td>
                                                <td class="text-center">
                                                    <a href="{{ route('show_slides', $chapter->id) }}"><button class="btn btn-outline-danger btn-small">Study Now</button></a>
                                                </td>
                                            @endif
                                        @else
                                            <td class="disflexc">
                                                <div class="progress cus-progress">
                                                    <div class="progress-bar" style="width:0%"></div>
                                                </div>
                                                0%
                                            </td>
                                            <td class="mw-td"><b>0</b>/0</td>
                                            @if( isStudyAllowed( $chapter->id ) )
                                                <td class="text-center">
                                                    <a href="{{ route('show_slides', $chapter->id) }}"><button class="btn btn-outline-danger btn-small last">Study Now</button></a>
                                                </td>
                                            @endif
                                        @endif
                                    </tr>
                                @endforeach
                                @if ( ! $user->final_quiz->isEmpty() )
                                    <tr>
                                        <td><h5><strong>Final Quiz</strong></h5></td>
                                        <td class="disflexc">
                                            <div class="progress cus-progress">
                                                <div class="progress-bar" style="width:{{ $user->final_quiz->last()->percentage }}%"></div>
                                            </div>
                                            {{ $user->final_quiz->last()->percentage }}%
                                            <td class="mw-td"><b>{{ $user->final_quiz->last()->total_correct }}</b>/ {{ $user->final_quiz->last()->total_questions }}</td>
                                            <td class="text-center">
                                                <button class="btn btn-outline-primary btn-small" disabled>{{ ucfirst($user->final_quiz->last()->result_status) }}</button>
                                                &nbsp;
                                                @if( $user->final_quiz->last()->result_status == 'failed' )
                                                    <a href="{{ route('quiz', 'final') }}"><button style="width: 62%;" class="btn btn-outline-danger btn-small">Take Final Quiz</button></a>
                                                @elseif( $user->final_quiz->last()->result_status == 'passed' )
                                                    <a href="{{ route('quiz', 'final') }}"><button style="width: 62%;" class="btn btn-outline-danger btn-small">View Result</button></a>
                                                @endif
                                            </td>
                                        </td>
                                    </tr>
                                @elseif( isFinalQuizAllowed() )
                                    <tr>
                                        <td><h5><strong>Final Quiz</strong></h5></td>
                                        <td class="disflexc">
                                            <div class="progress cus-progress">
                                                <div class="progress-bar" style="width: 0%"></div>
                                            </div>
                                            0%
                                            <td class="mw-td"> - </td>
                                            <td class="text-center">
                                                <a href="{{ route('quiz', 'final') }}"><button style="width: 62%;" class="btn btn-outline-danger btn-small">Take Final Quiz</button></a>
                                            </td>
                                        </td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>

            @include('partials.referral_block')
        </div>
    </div>

</div>
@endsection

@section('footer_scripts')
<script>
    $(document).ready(function(){
        @if( ! $user->consent_document )
            var notification = $('#siteNoticeBar').notificationBanner({
                text: 'Please submit consent document on my account page.&nbsp; &nbsp; &nbsp;<a href="{{ asset(getMetaValue("consent_form")) }}" download><button type="button" class="btn btn-small btn-primary">Download</button></a>',
                //position:"top",
                height:"50px",
                padding:"10px",
                width:"100%"
            });
        @endif
    });
</script>
@endsection
