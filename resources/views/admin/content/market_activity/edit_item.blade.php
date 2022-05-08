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
                  <li class="breadcrumb-item"><a href="{{ route('admin.marketActivity') }}">Market Activity</a></li>
                  <li class="breadcrumb-item" aria-current="page">Edit</li>
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
              <h3 class="mb-0">Edit</h3>
            </div>
            <div class="card-body">
              <form method="POST" preloader-ajax-form=".card" class="ajax-form custom-form" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                  <label for="name" class="form-control-label">Name:</label>
                  <input class="form-control" type="text" id="name" name="name" autocomplete="off" required="required" value="{{ $item->name }}" placeholder="{{ $item->name }}">
                  <div class="invalid-feedback error-text name_error"></div>
                  @error('name')
                    <div class="invalid-feedback d-noen">{{ $message }}</div>
                  @enderror
                </div>
                <div class="form-group">
                  <label for="volume" class="form-control-label">Volume:</label>
                  <input class="form-control" type="text" id="volume" name="volume" autocomplete="off" required="required" value="{{ number_format(intval($item->volume), 0, '.', '') }}" placeholder="{{ number_format(intval($item->volume), 0, '.', '') }}">
                  <div class="invalid-feedback error-text volume_error"></div>
                  @error('volume')
                    <div class="invalid-feedback d-noen">{{ $message }}</div>
                  @enderror
                </div>
                <div class="form-group">
                  <label for="shift" class="form-control-label">Changes in 24 hours:</label>
                  <input class="form-control" type="text" id="shift" name="shift" autocomplete="off" required="required" value="{{ number_format(floatval($item->shift), 2, '.', '') }}" placeholder="{{ number_format(floatval($item->shift), 2, '.', '') }}">
                  <div class="invalid-feedback error-text shift_error"></div>
                  @error('shift')
                    <div class="invalid-feedback d-noen">{{ $message }}</div>
                  @enderror
                </div>
                <div class="form-group">
                  <label for="floor_price" class="form-control-label">Floor price:</label>
                  <input class="form-control" type="text" id="floor_price" name="floor_price" autocomplete="off" required="required" value="{{ number_format(floatval($item->floor_price), 2, '.', '') }}" placeholder="{{ number_format(floatval($item->floor_price), 2, '.', '') }}">
                  <div class="invalid-feedback error-text floor_price_error"></div>
                  @error('floor_price')
                    <div class="invalid-feedback d-noen">{{ $message }}</div>
                  @enderror
                </div>
                <div class="form-group">
                  <label for="status" class="form-control-label">Status:</label>
                  <select name="status" id="status" class="form-control" autocomplete="off" required>
                    <option @if($item->status === 'active') selected @endif value="active">active</option>
                    <option @if($item->status === 'deactivated') selected @endif value="deactivated">deactivated</option>
                  </select>
                  <div class="invalid-feedback error-text status_error"></div>
                  @error('status')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                  @enderror
                </div>
                <div class="form-group">
                  <label for="preview" class="form-control-label">Area to upload item preview:</label>
                  <input type="text" name="remote_preview" hidden="hidden" autocomplete="off">
                  <input type="file" name="preview" id="preview" hidden="hidden" autocomplete="off">
                  <div class="invalid-feedback error-text preview_error"></div>
                  @error('preview')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                  @enderror
                </div>
                <div class="form-group">
                  <label for="icon_coin" class="form-control-label">Area to upload icon coin:</label>
                  <input type="text" name="remote_icon_coin" hidden="hidden" autocomplete="off">
                  <input type="file" name="icon_coin" id="icon_coin" hidden="hidden" autocomplete="off">
                  <div class="invalid-feedback error-text icon_coin_error"></div>
                  @error('icon_coin')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                  @enderror
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
    var preview = [{
      'name': '{{ $item->preview }}',
      'size': '{{ Storage::disk('public')->size('/images/MarketActivity/preview/' . $item->preview) }}',
      'type': '{{ Storage::disk('public')->mimeType('/images/MarketActivity/preview/' . $item->preview) }}',
      'file': '{{ '/uploads/images/MarketActivity/preview/' . $item->preview }}'
    }];
    var icon_coin = [{
      'name': '{{ $item->icon_coin }}',
      'size': '{{ Storage::disk('public')->size('/images/MarketActivity/icons_coin/' . $item->icon_coin) }}',
      'type': '{{ Storage::disk('public')->mimeType('/images/MarketActivity/icons_coin/' . $item->icon_coin) }}',
      'file': '{{ '/uploads/images/MarketActivity/icons_coin/' . $item->icon_coin }}'
    }];
  </script>

  {{ HTML::script('admin/js/content/market_activity/edit_item.js') }}
  {{ HTML::script('admin/js/ajax-form.js') }}

@endsection