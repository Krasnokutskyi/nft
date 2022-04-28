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
                  <li class="breadcrumb-item" aria-current="page">Content</li>
                  <li class="breadcrumb-item" aria-current="page">Blog</li>
                  <li class="breadcrumb-item"><a href="{{ route('admin.blog.categories') }}">Categories</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Create category</li>
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
              <h3 class="mb-0">Create category</h3>
            </div>
            <div class="card-body">
              <form method="POST" preloader-ajax-form=".card" class="ajax-form custom-form">
                @csrf
                <div class="form-group has-validation">
                  <label for="title-input" class="form-control-label">Title:</label>
                  <input class="form-control" type="text" id="title-input" name="title"  autocomplete="off" required>
                  <div class="invalid-feedback error-text title_error"></div>
                  @error('title')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                  @enderror
                </div>
                <div class="form-group">
                  <label for="alias-input" class="form-control-label">Alias for category:</label>
                  <input class="form-control" type="text" id="alias-input" name="alias" data-url_category="{{ route('blog.postsByCategory', ['alias' => "%alias%"]) }}" autocomplete="off" required>
                  <div id="alias-input" class="form-text subtitle" data-head="Category URL:"></div>
                  <div class="invalid-feedback error-text alias_error"></div>
                  @error('alias')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                  @enderror
                </div>
                <div class="form-group">
                  Category access:
                  <select name="access" class="form-control form-control-lg" required>
                    <option value="all">All</option>
                    @if ($packages->count() > 0)
                      <option value="packages">By package</option>
                    @endif
                    <option value="nobody">Nobody</option>
                  </select>
                  <div class="invalid-feedback error-text access_error"></div>
                  @error('access')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                  @enderror
                </div>
                @if ($packages->count() > 0)
                  <div class="form-group categories-packages d-none">
                    <label for="checkbox_package">Category will be access for packages:</label>
                    <div class="checkboxradio-group">
                      @foreach ($packages as $package)
                        <div class="form-check">
                          <input type="checkbox" name="packages[]" value="{{ $package->id }}" id="{{ $package->id }}-package-checkbox" class="form-check-input" autocomplete="off">
                          <label class="form-check-label" for="{{ $package->id }}-package-checkbox">
                            {{ $package->name }}
                          </label>
                        </div>
                      @endforeach
                    </div>
                    <div class="invalid-feedback error-text packages_error"></div>
                    @error('packages')
                      <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                  </div>
                @endif
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

  {{ HTML::script('admin/js/content/blog/create_category.js') }}
  {{ HTML::script('admin/js/ajax-form.js') }}

@endsection