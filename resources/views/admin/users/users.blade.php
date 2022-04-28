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
                  <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
                  <li class="breadcrumb-item active" aria-current="page">Users</li>
                </ol>
              </nav>
            </div>
            <div class="col-lg-6 col-5 text-right">
              <a href="{{ route('admin.users.register') }}" class="btn btn-sm btn-neutral">Register user</a>
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
              <h3 class="mb-0">Users</h3>
            </div>
            <!-- Light table -->
            <div class="table-responsive overflow-visible">
              <table class="table align-items-center table-flush">
                <thead class="thead-light">
                  <tr>
                    <th scope="col" class="sort" data-sort="name" style="width: 5%;">#</th>
                    <th scope="col" class="sort" data-sort="name">Full name</th>
                    <th scope="col" class="sort" data-sort="status">Telephone</th>
                    <th scope="col">Email</th>
                    <th scope="col" width="5%"></th>
                  </tr>
                </thead>
                <tbody class="list">
                  @foreach ($users as $user)
                    <tr>
                      <td class="budget">
                        {{ $user->id }}
                      </td>
                      <td class="budget">
                        {{ $user->first_name }} {{ $user->last_name }}
                      </td>
                      <td class="budget">
                        {{ $user->phone }}
                      </td>
                      <td class="budget">
                        {{ $user->email  }}
                      </td>
                      <td>
                        <div class="dropdown">
                          <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-v"></i>
                          </a>
                          <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                            <a class="dropdown-item" href="{{ route('admin.users.edit', ['user_id' => $user->id]) }}">Edit</a>
                            <a class="dropdown-item" href="{{ route('admin.users.deleteAction', ['user_id' => $user->id]) }}" onclick="delete_user(this)">Delete</a>
                          </div>
                        </div>
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
            <!-- Card footer -->
            @if($users->lastPage() > 1 or $users->count() == 0)  
              <div class="card-footer py-4">
                @if ($users->lastPage() > 1)
                  {{ $users->links('admin.layouts.pagination') }}
                @endif
                @if ($users->count() == 0)
                  <p class="m-0 font-weight-normal text-center">Users haven't been found. <a href="{{ route('admin.users.register') }}">Register user now</a></p>
                @endif
              </div>
            @endif
          </div>
        </div>
      </div>
    </div>
  </div>

  {{ HTML::script('/admin/js/users/users.js') }}

@endsection