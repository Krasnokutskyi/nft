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
                  <li class="breadcrumb-item"><a href="{{ route('admin.packages') }}">Packages</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Create package</li>
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
              <h3 class="mb-0">Create package</h3>
            </div>
            <div class="card-body">
              <form method="POST" preloader-ajax-form=".card" class="ajax-form custom-form">
                @csrf
                <div class="form-group">
                  <label for="name-input" class="form-control-label">Name:</label>
                  <input class="form-control" type="text" id="name-input" name="name" autocomplete="off" required>
                  <div class="invalid-feedback error-text name_error"></div>
                  @error('name')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                  @enderror
                </div>
                <div class="form-group">
                  <label for="price-input" class="form-control-label">Price:</label>
                  <input class="form-control" type="text" id="price-input" name="price" autocomplete="off" required>
                  <div class="invalid-feedback error-text price_error"></div>
                  @error('price')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                  @enderror
                </div>
                <div class="form-group">
                  <label class="form-control-label">Access to content:</label>
                  <div class="checkboxradio-group">
                    <div class="form-check">
                      <input type="checkbox" name="content[]" value="videos" id="videos-category-checkbox" class="form-check-input" autocomplete="off">
                      <label class="form-check-label" for="videos-category-checkbox">
                        Videos
                      </label>
                    </div>
                    <div class="form-check">
                      <input type="checkbox" name="content[]" value="blog" id="blog-category-checkbox" class="form-check-input" autocomplete="off">
                      <label class="form-check-label" for="blog-category-checkbox">
                        Blog
                      </label>
                    </div>
                    <div class="form-check">
                      <input type="checkbox" name="content[]" value="downloads" id="downloads-category-checkbox" class="form-check-input" autocomplete="off">
                      <label class="form-check-label" for="downloads-category-checkbox">
                        Downloads
                      </label>
                    </div>
                    <div class="form-check">
                      <input type="checkbox" name="content[]" value="calendar" id="calendar-category-checkbox" class="form-check-input" autocomplete="off">
                      <label class="form-check-label" for="calendar-category-checkbox">
                        Calendar
                      </label>
                    </div>
                    <div class="form-check">
                      <input type="checkbox" name="content[]" value="market activity" id="market_activity-category-checkbox" class="form-check-input" autocomplete="off">
                      <label class="form-check-label" for="market_activity-category-checkbox">
                        Market Activity
                      </label>
                    </div>
                  </div>
                  <div class="invalid-feedback error-text content_error"></div>
                  @error('content')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                  @enderror
                </div>
                <div class="form-group">
                  <label for="checkbox_redirect_content" class="form-control-label">After registration, redirect a user to:</label>
                  <select name="redirect_content[]" class="form-control" id="checkbox_redirect_content" autocomplete="off"></select>
                  <div class="invalid-feedback error-text redirect_content_error"></div>
                  @error('redirect_content')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                  @enderror
                </div>
                <div class="text-right">
                  <button type="submit" class="btn btn-success mt-4">Create</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  {{ HTML::script('/admin/js/packages/create_package.js') }}
  {{ HTML::script('/admin/js/ajax-form.js') }}

@endsection