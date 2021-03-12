@extends('layouts.app')

@section('content')
<div class="site-content">
    <div class="login-wrapper">
        <div class="login-div">
            <div class="sec-title text-center">
                <h1>Forgot Password</h1>
            </div>
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif
            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <div class="mt-5">
                    <div class="form-group">
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Email Address" autocomplete="email" required autofocus>

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    
                    </div>
                </div>

                <div class="text-center mt-5">
                    <button class="btn btn-primary" type="submit">Reset Password
                        <i class="icon-arrow-right ml-2"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
