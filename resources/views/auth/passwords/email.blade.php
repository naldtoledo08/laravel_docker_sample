@extends('layouts.app_empty')

@section('content')
<div class="page login-page">
  <div class="container">
    <div class="form-outer text-center d-flex align-items-center">
      <div class="form-inner">
        <div class="logo">
            <strong class="text-primary">Forgot your Password?</strong>
        </div>
        <p>Please enter you email below and we will send you instruction to reset your password.</p>

        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}">
            @csrf
            <div class="form-group row">
                <label for="email" class="col-md-4 col-form-label">{{ __('E-Mail Address') }}</label>
                <div class="col-md-8">
                    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                    @if ($errors->has('email'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group row mb-0">
                <div class="col-md-6 offset-md-4">
                    <button type="submit" class="btn btn-primary">
                        {{ __('Send Password Reset Link') }}
                    </button>
                </div>
            </div>
        </form>

        <small>Do not have an account? </small><a href="register.html" class="signup">Signup</a>
        <div class="form-group">
            <small>Go back to </small><a href="{{ route('login') }}" class="signup">Signin</a>
        </div>

      </div>
      <div class="copyrights text-center">
        <p>Design by <a href="https://bootstrapious.com" class="external">Bootstrapious</a></p>
        <!-- Please do not remove the backlink to us unless you support further theme's development at https://bootstrapious.com/donate. It is part of the license conditions. Thank you for understanding :)-->
      </div>
    </div>
  </div>
</div>
@endsection