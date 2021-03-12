@extends('layouts.app')

@section('content')
<div class="insite-content">
    <div class="site-part">
        <div class="container">
            <div class="sec-title">
                <h1>{!! $page->title !!}</h1>
            </div>

            <div class="mt-2"></div>

            {!! $page->content !!}
            
        </div>
    </div>
</div>
@endsection