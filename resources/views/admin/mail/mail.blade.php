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
                  <li class="breadcrumb-item" aria-current="page">Mail</li>
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
              <h3 class="mb-0">Send Mail</h3>
            </div>
            <div class="card-body">
              <form method="POST" preloader-ajax-form=".card" class="ajax-form create_post-form custom-form">
                @csrf
                <div class="form-group">
                  <label for="title-input" class="form-control-label">Title:</label>
                  <input class="form-control" type="text" id="title-input" name="title"  autocomplete="off" required>
                  <div class="invalid-feedback error-text title_error"></div>
                  @error('title')
                    <div class="invalid-feedback d-noen">{{ $message }}</div>
                  @enderror
                </div>
                <div class="form-group text-editor-container">
                  <textarea name="text" hidden="hidden" autocomplete="off"></textarea>
                  <label for="editor" class="form-label">Text:</label>
                  <div id="editor" style="border: unset;"></div>
                  <div class="invalid-feedback error-text text_error"></div>
                  @error('text')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                  @enderror
                </div>
                <div class="form-group post-packages">
                  <label for="checkbox_package">Send mail to users by package:</label>
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
                <div class="text-right">
                  <button type="submit" class="btn btn-success mt-4">
                    Send
                  </button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  {{ HTML::script('admin/js/mail/mail.js') }}
  {{ HTML::script('admin/js/ajax-form.js') }}

@endsection