@extends('admin.auth.app-auth')

@section('title')
    Admin Login | SECURTAC
@endsection

@section('content')
    @include('admin.partials.flash-message')

    <div class="card">
        <div class="card-body login-card-body">
            
            <p class="login-box-msg">Sign in to access admin area</p>
            <form action="{{ route('admin.login.action') }}" method="post">
                
                @csrf
                
                <div class="input-group mb-3">
                    <input name="email" type="email" class="form-control @error('email') is-invalid @enderror" placeholder="{{ __('E-Mail Address') }}" autocomplete="email" required>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                    @error('email')
                        <div class="invalid-feedback">
                            {{ $errors->first('email') }}
                        </div>
                    @enderror
                </div>
                <div class="input-group mb-3">
                    <input name="password" type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password" autocomplete="current-password" required>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                    @error('password')
                        <div class="invalid-feedback">
                            {{ $errors->first('password') }}
                        </div>
                    @enderror
                </div>
                <div class="row">
                    <div class="col-8">
                        {{-- <div class="icheck-primary">
                            <input name="remember" type="checkbox" id="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label for="remember">
                                {{ __('Remember Me') }}
                            </label>
                        </div> --}}
                    </div>
                    <!-- /.col -->
                    <div class="col-4">
                        <button type="submit" class="btn btn-primary btn-block">{{ __('Sign In') }}</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>
            <p class="mb-1">
                <a href="{{ route('admin.password.request') }}">
                    {{ __('I forgot my password') }}
                </a>
            </p>
        </div>
        <!-- /.login-card-body -->
    </div>
@endsection