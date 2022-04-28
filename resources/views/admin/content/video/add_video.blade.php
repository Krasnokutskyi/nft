@extends('admin.layouts.app')

@section('content')
  <!-- Sidenav -->
  @include('admin.layouts.sidebar')
  <!-- Main content -->
  <div class="main-content ctreate_post" id="panel">
    <!-- Header -->
    <div class="header bg-primary pb-6">
      <div class="container-fluid">
        <div class="header-body">
          <div class="row align-items-center py-4">
            <div class="col-lg-6 col-7">
              <nav aria-label="breadcrumb" class="d-none d-md-inline-block">
                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                  <li class="breadcrumb-item"><a href="{{ route('admin.home') }}"><i class="fas fa-home"></i></a></li>
                  <li class="breadcrumb-item">Content</li>
                  <li class="breadcrumb-item"><a href="{{ route('admin.video.posts') }}">Videos</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Add video</li>
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
              <h3 class="mb-0">Add video</h3>
            </div>
            <div class="card-body">
              <form method="POST" preloader-ajax-form=".card" class="ajax-form custom-form" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                  <label for="title-input" class="form-control-label">Title:</label>
                  <input class="form-control" type="text" id="title-input" name="title" autocomplete="off" required="required">
                  <div class="invalid-feedback error-text title_error"></div>
                  @error('title')
                    <div class="invalid-feedback d-noen">{{ $message }}</div>
                  @enderror
                </div>
                @if ($categories->count() > 0)
                  <div class="form-group">
                    <label class="form-control-label">Categories:</label>
                    <div class="checkboxradio-group">
                      @foreach ($categories as $category)
                        <div class="form-check">
                          <input type="checkbox" name="categories[]" value="{{ $category->id }}" id="{{ $category->id }}-category-checkbox" class="form-check-input" autocomplete="off">
                          <label class="form-check-label" for="{{ $category->id }}-category-checkbox">
                            {{ $category->title }}
                          </label>
                        </div>
                      @endforeach
                    </div>
                    <div class="invalid-feedback error-text categories_error"></div>
                    @error('categories')
                      <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                  </div>
                @endif
                <div class="form-group">
                  <label class="form-control-label">Video access:</label>
                  <select name="access" class="form-control form-control-lg" autocomplete="off" required="required">
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
                  <div class="form-group post-packages d-none">
                    <label class="form-control-label">Video will be access for packages:</label>
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
                <div class="form-group">
                  <label for="video" class="form-control-label">Area to upload video file:</label>
                  <input type="file" name="video" id="video" multiple="multiple" hidden="hidden" autocomplete="off">
                  <div class="invalid-feedback error-text video_error"></div>
                </div>
                <div class="form-group">
                  <label for="preview" class="form-control-label">Area to upload video preview:</label>
                  <input type="file" name="preview" id="preview" hidden="hidden" autocomplete="off">
                  <div class="invalid-feedback error-text preview_error"></div>
                </div>
                <div class="text-right">
                  <button type="submit" class="btn btn-success mt-4">
                    Add
                  </button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  {{ HTML::script('admin/js/ajax-form.js') }}
  {{ HTML::script('admin/js/content/video/add_video.js') }}

@endsection