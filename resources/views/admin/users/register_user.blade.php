@extends('admin.layouts.app')

@section('content')
  <!-- Sidenav -->
  @include('admin.layouts.sidebar')
  <!-- Main content -->
  <div class="main-content" id="panel">
    <!-- Header -->
    <div class="header bg-primary pb-6">
      <div class="container-fluid">
        <div class="header-body">
          <div class="row align-items-center py-4">
            <div class="col-lg-6 col-7">
              <nav aria-label="breadcrumb" class="d-none d-md-inline-block">
                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                  <li class="breadcrumb-item"><a href="{{ route('admin.home') }}"><i class="fas fa-home"></i></a></li>
                  <li class="breadcrumb-item"><a href="{{ route('admin.users') }}">Users</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Register user</li>
                </ol>
              </nav>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Page content -->
    <div class="container-fluid mt--6">
      <div class="row">
        <div class="col">
          <div class="card">
            <!-- Card header -->
            <div class="card-header">
              <h3 class="mb-0">Create user</h3>
            </div>
            <div class="card-body">
              <form method="POST" class="ajax-form custom-form">
                @csrf
                <div class="row">
                  <div class="col-md-6 col-sm-12">
                    <div class="form-group">
                      <label for="first_name-input" class="form-control-label">First Name:</label>
                      <input class="form-control" type="text" id="first_name-input" name="first_name"  autocomplete="off" required>
                      <div class="invalid-feedback error-text first_name_error"></div>
                      @error('first_name')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-6 col-sm-12">
                    <div class="form-group">
                      <label for="last_name-input" class="form-control-label">Last Name:</label>
                      <input class="form-control" type="text" id="last_name-input" name="last_name" autocomplete="off" required>
                      <div class="invalid-feedback error-text last_name_error"></div>
                      @error('last_name')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                      @enderror
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label for="phone-input" class="form-control-label">Telephone:</label>
                  <input class="form-control" type="text" id="phone-input" name="phone" autocomplete="off" required>
                  <div class="invalid-feedback error-text phone_error"></div>
                  @error('phone')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                  @enderror
                </div>
                <div class="form-group">
                  <label for="email-input" class="form-control-label">Email:</label>
                  <input class="form-control" type="email" id="email-input" name="email" autocomplete="off" required>
                  <div class="invalid-feedback error-text email_error"></div>
                  @error('email')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                  @enderror
                </div>
                <div class="form-group">
                  <label for="password-input" class="form-control-label">Password:</label>
                  <input class="form-control" type="password" id="password-input" name="password" autocomplete="off" required>
                  <div class="invalid-feedback error-text password_error"></div>
                  @error('password')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                  @enderror
                </div>
                <div class="form-group">
                  <label for="checkbox_package" class="form-control-label">Package:</label>
                  <select name="package" class="form-control" id="checkbox_package" autocomplete="off" required>
                    @foreach ($packages as $package)
                      <option value="{{ $package->id }}">{{ $package->name }}</option>
                    @endforeach
                  </select>
                  <div class="invalid-feedback error-text package_error"></div>
                  @error('packages')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                  @enderror
                </div>
                <div class="text-right">
                  <button type="submit" class="btn btn-success mt-4">Register</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  {{ HTML::script('/admin/js/ajax-form.js') }}
  {{ HTML::script('/admin/js/users/register_user.js') }}

@endsection