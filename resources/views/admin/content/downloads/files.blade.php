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
                  <li class="breadcrumb-item" aria-current="page">Downloads</li>
                  <li class="breadcrumb-item active" aria-current="page">Files</li>
                </ol>
              </nav>
            </div>
            <div class="col-lg-6 col-5 text-right">
              <a href="{{ route('admin.downloads.files.upload') }}" class="btn btn-sm btn-neutral">Upload file</a>
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
              <h3 class="mb-0">Files</h3>
            </div>
            <!-- Light table -->
            <div class="table-responsive overflow-visible">
              <table class="table align-items-center table-flush categories-table">
                <thead class="thead-light">
                  <tr>
                    <th scope="col" class="sort" data-sort="name" style="width: 5%">File Id</th>
                    <th scope="col" class="sort" data-sort="name">Title</th>
                    <th scope="col" class="sort" data-sort="name" style="width: 20%">Type</th>
                    <th scope="col" style="width: 5%"></th>
                  </tr>
                </thead>
                <tbody class="list">
                  @foreach ($files as $file)
                    <tr>
                      <td class="budget">
                        {{ $file->id }}
                      </td>
                      <td class="budget">
                        {{ $file->title }}
                      </td>
                      <td class="budget">
                        {{ $file->type->first()->title }}
                      </td>
                      <td class="text-right">
                        <div class="dropdown">
                          <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-v"></i>
                          </a>
                          <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                            <a class="dropdown-item" href="{{ route('storage.content.downloads.file', ['file' => $file->file]) }}" download="{{ $file->title . '.' . pathinfo(route('storage.content.downloads.file', ['file' => $file->file]), PATHINFO_EXTENSION) }}" onclick="downloadFile(event, this)">Download</a>
                            <a class="dropdown-item" href="{{ route('admin.downloads.files.edit', ['file_id' => $file->id]) }}">Edit</a>
                            <a class="dropdown-item" href="{{ route('admin.downloads.files.deleteAction', ['file_id' => $file->id]) }}"  onclick="remove_file(this)">Delete</a>
                          </div>
                        </div>
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
            <!-- Card footer -->
            @if($files->lastPage() > 1 or $files->count() == 0)  
              <div class="card-footer py-4">
                @if ($files->lastPage() > 1)
                  {{ $posts->links('admin.layouts.pagination') }}
                @endif
                @if ($files->count() == 0)
                  <p class="m-0 font-weight-normal text-center">Files haven't been found. <a href="{{ route('admin.downloads.files.upload') }}">Upload file now</a></p>
                @endif
              </div>
            @endif
          </div>
        </div>
      </div>
    </div>
  </div>

  {{ HTML::script('/admin/js/content/downloads/files.js') }}

@endsection