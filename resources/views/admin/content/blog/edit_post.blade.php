@extends('admin.layouts.app')

@section('content')
  <!-- Sidenav -->
  @include('admin.layouts.sidebar')
  <!-- Main content -->
  <div class="main-content edit_post" id="panel">
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
                  <li class="breadcrumb-item">Blog</li>
                  <li class="breadcrumb-item"><a href="{{ route('admin.blog.posts') }}">Posts</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Edit post</li>
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
              <h3 class="mb-0">Edit post</h3>
            </div>
            <div class="card-body">
              <form method="POST" class="ajax-form custom-form edit_post-form" enctype="multipart/form-data">
                @csrf
                <div class="form-group has-validation">
                  <label for="title-input" class="form-control-label">Title:</label>
                  <input class="form-control" type="text" value="{{ $post->title }}" id="title-input" name="title"  autocomplete="off" required>
                  <div class="invalid-feedback error-text title_error"></div>
                  @error('title')
                    <div class="invalid-feedback d-noen">{{ $message }}</div>
                  @enderror
                </div>
                <div class="form-group">
                  <label for="alias-input" class="form-control-label">Alias for post:</label>
                  <input class="form-control" type="text" id="alias-input" name="alias" value="{{ $post->alias }}" data-url_post="{{ route('blog.post', ['alias' => '%alias%']) }}" autocomplete="off" required>
                  <div id="alias-input" class="form-text subtitle" data-head="Post URL:"></div>
                  <div class="invalid-feedback error-text alias_error"></div>
                  @error('alias')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                  @enderror
                </div>
                <div class="form-group text-editor-container">
                  <textarea name="text" hidden="hidden" autocomplete="off">{{ $post->text }}</textarea>
                  <label for="editor" class="form-label">Text:</label>
                  <div id="editor" style="border: unset;">{!! $post->text !!}</div>
                  <div class="invalid-feedback error-text text_error"></div>
                  @error('text')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                  @enderror
                </div>
                @if ($categories->count() > 0)
                  <div class="form-group">
                    <label for="categories-checkbox">Categories:</label>
                    <div class="checkboxradio-group">
                      @foreach ($categories as $category)
                        <div class="form-check">
                          <input @if ($post->categories->where('id', '=', $category->id)->count() === 1) checked @endif type="checkbox" name="categories[]" value="{{ $category->id }}" id="{{ $category->id }}-category-checkbox" class="form-check-input">
                          <label class="form-check-label" for="{{ $category->id }}-category-checkbox">{{ $category->title }}</label>
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
                  Post access:
                  <select name="access" class="form-control form-control-lg" autocomplete="off" required>
                    <option @if($post->access === 'all') selected @endif value="all">All</option>
                    @if ($packages->count() > 0)
                      <option @if($post->access === 'packages') selected @endif value="packages">By package</option>
                    @endif
                    <option @if($post->access === 'nobody') selected @endif value="nobody">Nobody</option>
                  </select>
                  <div class="invalid-feedback error-text access_error"></div>
                  @error('access')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                  @enderror
                </div>
                @if ($packages->count() > 0)
                  <div class="form-group post-packages d-none">
                    <label for="checkbox_package">Post will be access for packages:</label>
                    <div class="checkboxradio-group">
                      @foreach ($packages as $package)
                        <div class="form-check">
                          <input @if($post->packages->where('id', '=', $package->id)->count() > 0) checked @endif  type="checkbox" name="packages[]" value="{{ $package->id }}" id="{{ $package->id }}-package-checkbox" class="form-check-input" autocomplete="off">
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
                  <label for="preview">Area to upload post preview:</label>
                  <input type="text" name="remote_preview" hidden="hidden" autocomplete="off">
                  <input type="file" name="preview" id="preview" hidden="hidden" autocomplete="off">
                  <div class="invalid-feedback error-text preview_error"></div>
                </div>
                <div class="text-right">
                  <button type="submit" class="btn btn-success mt-4">
                    Save
                  </button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script type="text/javascript">
    var preview = {!! json_encode($post->preview) !!};
  </script>

  {{ HTML::script('admin/js/content/blog/edit_post.js') }}
  {{ HTML::script('admin/js/ajax-form.js?v=1.2.0') }}

@endsection