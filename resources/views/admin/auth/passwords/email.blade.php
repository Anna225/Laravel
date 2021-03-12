@extends('admin.auth.app-auth')

@section('title')
    Forgot Password | SECURTAC
@endsection

@section('content')
<div class="card">
    <div class="card-body login-card-body">
        @include('admin.partials.flash-message')

        <p class="login-box-msg">You forgot your password? Here you can easily retrieve a new password.</p>

        <form action="{{ route('admin.password.email') }}" method="post">

            @csrf

            <div class="input-group mb-3">
                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" placeholder="Email" autocomplete="email" required autofocus>
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-envelope"></span>
                    </div>
                </div>
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="row">
                <div class="col-12">
                    <button type="submit" class="btn btn-primary btn-block">{{ __('Send Password Reset Link') }}</button>
                </div>
            </div>
        </form>

        <p class="mt-3 mb-1">
            <a href="{{ route('admin.login') }}">Login</a>
        </p>
    </div>
    <!-- /.login-card-body -->
</div>
@endsection
