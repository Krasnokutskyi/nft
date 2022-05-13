@extends('admin.layouts.app', ['title' => __('User Profile')])

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
                  <li class="breadcrumb-item">Content</li>
                  <li class="breadcrumb-item" aria-current="page">Market Activity</li>
                </ol>
              </nav>
            </div>
            <div class="col-lg-6 col-5 text-right">
              <button type="button" class="btn btn-sm btn-neutral js__p_start">Parse Data</button>
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
            <div class="card-header border-0">
              <h3 class="mb-0">Market Activity</h3>
            </div>
            <!-- Light table -->
            <div class="table-responsive overflow-visible">
              <table class="table align-items-center table-flush categories-table">
                <thead class="thead-light">
                  <tr>
                    <th scope="col"></th>
                    <th scope="col">Name</th>
                    <th scope="col" width="20%">Volume</th>
                    <th scope="col" width="10%">24h %</th>
                    <th scope="col" width="5%">Floor price</th>
                    <th scope="col" width="10%">Status</th>
                    <th scope="col" width="5%"></th>
                  </tr>
                </thead>
                <tbody class="list" data-url_sortable="{{ route('admin.marketActivity.sortableAction') }}">
                  @foreach ($market_activity as $item)
                    <tr data-market_id="{{ $item->id }}">
                      <td class="budget preview_item-table">
                        <img src="/uploads/images/MarketActivity/preview/{{ $item->preview }}" alt="{{ $item->name }}">
                      </td>
                      <td class="budget">
                        {{ $item->name }}
                      </td>
                      <td class="budget">
                        {{ number_format(intval($item->volume), 0, ',', ',') }}
                      </td>
                      <td class="budget">
                        {{ number_format(floatval($item->shift), 2, '.', ',') }}%
                      </td>
                      <td class="budget">
                        {{ number_format(floatval($item->floor_price), 2, '.', ',') }}
                      </td>
                      <td class="budget">
                        {{ $item->status }}
                      </td>
                      <td class="text-right">
                        <div class="dropdown">
                          <a class="btn btn-sm btn-icon-only" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-v"></i>
                          </a>
                          <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                            <a class="dropdown-item" href="{{ route('admin.marketActivity.edit', ['item_id' => $item->id]) }}">Edit</a>
                            <a class="dropdown-item" href="{{ route('admin.marketActivity.delete', ['item_id' => $item->id]) }}"  onclick="remove_item(this)">Delete</a>
                          </div>
                        </div>
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
         
            @if($market_activity->count() == 0)
              <div class="card-footer py-4">
                  <p class="m-0 font-weight-normal text-center">List is empty.</p>
              </div>
            @endif
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="p_body js__p_body js__fadeout"></div>

  <div class="popup js__popup js__slide_top">
    <a href="#" class="p_close js__p_close" title="Закрыть">
      <span></span><span></span>
    </a>
    <div class="p_content">
      <form action="{{ route('admin.marketActivity.parser') }}" method="POST" preloader-ajax-form=".p_content" class="custom-form" enctype="multipart/form-data">
        @csrf
        <h1 class="title">Parser Data</h1>
        <div class="form-group">
          <label for="resource" class="form-control-label">Parse data from:</label>
          <select name="resource" id="resource" class="form-control" autocomplete="off" required>
            <option value="opensea">opensea.io</option>
          </select>
          <div class="invalid-feedback error-text resource_error"></div>
          @error('resource')
            <div class="invalid-feedback d-block">{{ $message }}</div>
          @enderror
        </div>
        <div class="form-group">
          <label for="count_raw" class="form-control-label">Count raw:</label>
          <input class="form-control" type="number" id="count_raw" name="count_raw" required value="12" placeholder="12" autocomplete="off">
          <div class="invalid-feedback error-text count_raw_error"></div>
          @error('count_raw')
            <div class="invalid-feedback d-block">{{ $message }}</div>
          @enderror
        </div>
        <div class="form-group">
          <label for="status" class="form-control-label">Set status:</label>
          <select name="status" id="status" class="form-control" autocomplete="off" required>
            <option value="active">active</option>
            <option selected value="deactivated">deactivated</option>
          </select>
          <div class="invalid-feedback error-text status_error"></div>
          @error('status')
            <div class="invalid-feedback d-block">{{ $message }}</div>
          @enderror
        </div>
        <div class="text-right">
          <button type="submit" class="btn btn-success mt-4">
            Parse
          </button>
        </div>
      </form>
    </div>
  </div>

  {{ HTML::script('/admin/js/content/market_activity/market_activity.js') }}
  {{ HTML::script('admin/js/ajax-form.js') }}

@endsection