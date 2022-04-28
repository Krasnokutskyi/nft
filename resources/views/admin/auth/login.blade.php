@extends('admin.layouts.app')

@section('content')

  <div class="header bg-gradient-primary py-7 py-lg-8">
    <div class="container">
      <div class="header-body text-center mb-7">
        <div class="row justify-content-center">
          <div class="col-lg-5 col-md-6">
            <h1 class="text-white text-uppercase display-2"><b>Admin Panel</b></h1>
          </div>
        </div>
      </div>
    </div>
    <div class="separator separator-bottom separator-skew zindex-100">
      <svg x="0" y="0" viewBox="0 0 2560 100" preserveAspectRatio="none" version="1.1" xmlns="http://www.w3.org/2000/svg">
        <polygon class="fill-default" points="2560 0 2560 100 0 100"></polygon>
      </svg>
    </div>
  </div>
  <div class="container mt--8 pb-5">
    <div class="row justify-content-center">
      <div class="col-lg-5 col-md-7">
        <div class="card bg-secondary shadow border-0">
          <div class="card-body px-lg-5 py-lg-5">
            <form class="ajax-form custom-form" role="form" method="POST">
              <h2 class="text-uppercase text-center display-4 position-relative bottom-2"><b>Login<b></h2>
              @csrf
              <div class="form-group">
                <div class="input-group input-group-alternative">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                  </div>
                  <input class="form-control" placeholder="{{ __('Email') }}" type="email" name="email"required autofocus>
                </div>
                <div class="invalid-feedback error-text email_error"></div>
                @error('email')
                  <span class="invalid-feedback" style="display: block;" role="alert">
                    <strong>{{ $errors->first('email') }}</strong>
                  </span>
                @enderror
              </div>
              <div class="form-group">
                <div class="input-group input-group-alternative">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                  </div>
                  <input class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="{{ __('Password') }}" type="password" value="secret" required>
                </div>
                <div class="invalid-feedback error-text password_error"></div>
                @error('password')
                  <span class="invalid-feedback" style="display: block;" role="alert">
                    <strong>{{ $errors->first('password') }}</strong>
                  </span>
                @enderror
              </div>
              <div class="custom-control custom-control-alternative custom-checkbox">
                <input class="custom-control-input" name="remember_me" id="customCheckLogin" type="checkbox">
                <label class="custom-control-label" for="customCheckLogin">
                  <span class="text-muted">{{ __('Remember me') }}</span>
                </label>
              </div>
              <p class="message_container"></p>
              <div class="text-center">
                  <button type="submit" class="btn btn-primary my-4">{{ __('Sign in') }}</button>
              </div>
            </form>
          </div>
        </div>
        <div class="row mt-3">
          <div class="col-6">
            @if (Route::has('password.request'))
              <a href="{{ route('password.request') }}" class="text-light">
                <small>{{ __('Forgot password?') }}</small>
              </a>
            @endif
          </div>
        </div>
      </div>
    </div>
  </div>

  <style type="text/css">
    body{
      background-color: #172b4d !important;
    }
  </style>

  {{ HTML::script('admin/js/ajax-form.js') }}

@endsection
