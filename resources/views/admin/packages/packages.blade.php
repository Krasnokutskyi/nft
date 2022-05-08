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
                  <li class="breadcrumb-item active" aria-current="page">Packages</li>
                </ol>
              </nav>
            </div>
            <div class="col-lg-6 col-5 text-right">
              <a href="{{ route('admin.packages.create') }}" class="btn btn-sm btn-neutral">Create package</a>
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
              <h3 class="mb-0">Packages</h3>
            </div>
            <!-- Light table -->
            <div class="table-responsive overflow-visible table-packages">
              <table class="table align-items-center table-flush categories-table">
                <thead class="thead-light">
                  <tr>
                    <th scope="col">Name</th>
                    <th scope="col" class="text-center" width="10%">Users</th>
                    <th scope="col" class="text-center" width="10%">Price</th>
                    <th scope="col" width="5%"></th>
                  </tr>
                </thead>
                <tbody class="list" data-url_sortable="{{ route('admin.packages.sortableAction') }}">
                  @foreach ($packages as $package)
                    <tr data-package_id="{{ $package->id }}">
                      <td class="budget">
                        {{ $package->name }}
                      </td>
                      <td class="budget text-center">
                        {{ $package->users()->count() }}
                      </td>
                      <td class="budget text-center">
                        {{ (floatval($package->discount) == 0) ? $package->price : $package->discount }}
                      </td>
                      <td class="text-right">
                        <div class="dropdown">
                          <a class="btn btn-sm btn-icon-only" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-v"></i>
                          </a>
                          <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                            <a class="dropdown-item" href="{{ route('admin.packages.edit', ['package_id' => $package->id]) }}">Edit</a>
                            <a class="dropdown-item" href="{{ route('admin.packages.deleteAction', ['package_id' => $package->id]) }}"  onclick="remove_package(this)">Delete</a>
                          </div>
                        </div>
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
            @if($packages->count() == 0)  
              <div class="card-footer py-4">
                <p class="m-0 font-weight-normal text-center">Packages haven't been found. <a href="{{ route('admin.packages.create') }}">Create package now</a></p>
              </div>
            @endif
          </div>
        </div>
      </div>
    </div>
  </div>

  {{ HTML::script('/admin/js/packages/packages.js') }}

@endsection