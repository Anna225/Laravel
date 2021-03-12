@extends('layouts.app')

@section('content')
<div class="site-content">
    <div class="login-wrapper">
        <div class="login-div">
            <div class="sec-title text-center">
                <h1>Reset Password</h1>
            </div>
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif
            <form method="POST" action="{{ route('password.update') }}">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">

                <div class="mt-5">
                    <div class="form-group">
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" placeholder="Email Address" autocomplete="email" required autofocus>

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                    </div>
                </div>

                <div class="form-group">
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="New Password">

                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="Confirm Password">
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
