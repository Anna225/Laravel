@extends('layouts.app')

@section('content')
<div class="site-content">

    <div class="login-wrapper">
        <div class="login-div">
            <div class="sec-title text-center">
                <h1>{{ __('Login') }}</h1>
            </div>
            <form action="{{ route('login') }}" method="POST">
                @csrf
                <div class="mt-5">
                    <div class="form-group">
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autocomplete="email" placeholder="Email Address" autofocus required>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="current-password" placeholder="Password" required>

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    {{-- <div class="form-group row">
                        <div class="col-md-6 offset-md-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                <label class="form-check-label" for="remember">
                                    {{ __('Remember Me') }}
                                </label>
                            </div>
                        </div>
                    </div> --}}
                    <p class="text-right">
                        <a href="{{ route('password.request') }}" class="site-link">{{ __('Forgot Password?') }}</a>
                    </p>
                </div>

                <div class="text-center mt-5">
                    <a href="course.html">
                        <button class="btn btn-primary" type="submit">Login
                            <i class="icon-arrow-right ml-2"></i>
                        </button>
                    </a>

                    <p class="text-center mt-3 mb-0 fw-700">
                        Do not have login, click here to <a href="{{ route('register') }}" class="theme-link">Register</a>
                    </p>
                </div>
            </form>
        </div>
    </div>

</div>
@endsection
