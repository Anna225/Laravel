@extends('layouts.app')

@section('content')
<div class="insite-content">

    <div class="site-part schedule-page">
        <div class="container">
            <div class="sec-title">
                <h1>Security Training Chapters</h1>
            </div>

            <div class="mt-30">
                <div class="row">
                    @foreach ( $trainingChapters as $key => $chapter )
                        <div class="col-sm-6 col-lg-4">
                            <div class="chapter-card">
                                @if ( ! isStudyAllowed( $chapter->id ) && ! isQuizAllowed( $chapter->id ) )
                                    <div class="chapter-lock">
                                        <h1 class="ic-lock"><i class="icon-padlock"></i></h1>
                                    </div>
                                @endif
                                <div class="row">
                                    <div class="col-6 left-cover">
                                        <img src="{{ $chapter->image_url }}" width="100%">
                                        <h4>Chapter {{ $key+1 }}</h4>
                                    </div>
                                    <div class="col-6 right-cover">
                                        <h6 class="fw-700 mb-3">{{ $chapter->name }}</h6>

                                        @if( $chapter->slides_count > 0 && isStudyAllowed( $chapter->id ) )
                                            <a href="{{ route('show_slides', $chapter->id ) }}">
                                                <button class="btn btn-outline-dark mw130 mb-3" type="submit">Tutorial
                                                    <i class="icon-arrow-right ml-2"></i>
                                                </button>
                                            </a>        
                                        @endif

                                        @if ( isQuizAllowed( $chapter->id ) )
                                            <a href="{{ route('quiz', $chapter->id) }}">
                                                <button class="btn btn-outline-dark mw130">Quiz
                                                    <i class="icon-arrow-right ml-2"></i>
                                                </button>
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

</div>
@endsection