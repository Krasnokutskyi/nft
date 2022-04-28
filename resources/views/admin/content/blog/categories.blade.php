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
                  <li class="breadcrumb-item" aria-current="page">Content</li>
                  <li class="breadcrumb-item" aria-current="page">Blog</li>
                  <li class="breadcrumb-item active" aria-current="page">Categories</li>
                </ol>
              </nav>
            </div>
            <div class="col-lg-6 col-5 text-right">
              <a href="{{ route('admin.blog.createCategory') }}" class="btn btn-sm btn-neutral">Create category</a>
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
              <h3 class="mb-0">Categories</h3>
            </div>
            <!-- Light table -->
            <div class="table-responsive overflow-visible">
              <table class="table align-items-center table-flush categories-table">
                <thead class="thead-light">
                  <tr>
                    <th scope="col" class="sort" data-sort="name">Title</th>
                    <th scope="col"></th>
                  </tr>
                </thead>
                <tbody class="list">
                  @foreach ($categories as $category)
                    <tr>
                      <td class="budget">
                        {{ $category->title }}
                      </td>
                      <td class="text-right">
                        <div class="dropdown">
                          <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-v"></i>
                          </a>
                          <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                            <a class="dropdown-item" href="{{ route('blog.postsByCategory', ['alias' => $category->alias]) }}">Show</a>
                            <a class="dropdown-item" href="{{ route('admin.blog.updateCategory', ['category_id' => $category->id]) }}">Edit</a>
                            <a class="dropdown-item" href="{{ route('admin.blog.deleteCategoryAction', ['category_id' => $category->id]) }}"  onclick="remove_category(this)">Delete</a>
                          </div>
                        </div>
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
            <!-- Card footer -->
            @if($categories->lastPage() > 1 or $categories->count() == 0)  
              <div class="card-footer py-4">
                @if ($categories->lastPage() > 1)
                  {{ $categories->links('admin.layouts.pagination') }}
                @endif
                @if ($categories->count() == 0)
                  <p class="m-0 font-weight-normal text-center">Categories haven't been found. <a href="{{ route('admin.video.createCategory') }}">Create category now</a></p>
                @endif
              </div>
            @endif
          </div>
        </div>
      </div>
    </div>
  </div>

  {{ HTML::script('admin/js/content/blog/categories.js') }}

@endsection