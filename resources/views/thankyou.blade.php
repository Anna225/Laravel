@extends('layouts.app')

@section('content')
    <div class="insite-content">

        <div class="site-part">
            <div class="container pt-5 text-center">
                <div>
                    <i class="icon-smile fs-70"></i>
                    <h1 class="fw-700 mt-3">Thanks for choosing us!</h1>
                    <div class="elash-round"></div>
                    <p>Lorem ipsum dolor sit amet, vix an natu tur eleifend, mel amet laorit menandri. Ei item justo
                        complectitur duo. Lorem ipsum dolor sit amet, vix an natu tur eleifend, mel amet laorit
                        menandri. Ei item justo complectitur duo.Lorem ipsum dolor sit amet </p>

                    <a class="btn btn-primary mt-4" href="{{ route('login') }}">
                        <i class="icon-arrow-right reverse-arrow ml-2"></i> Login
                    </a>
                </div>
            </div>
        </div>

    </div>
@endsection