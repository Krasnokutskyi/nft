<nav class="navbar navbar-vertical fixed-left navbar-expand-md navbar-light bg-white menu" id="sidenav-main">
  <div class="container-fluid">
    <!-- Toggler -->
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <!-- Brand -->
    <a class="navbar-brand pt-0" href="">
      <img src="{{ asset('admin') }}/img/brand/blue.png" class="navbar-brand-img" alt="...">
    </a>
    <!-- Collapse -->
    <div class="collapse navbar-collapse" id="sidenav-collapse-main">
      <!-- Collapse header -->
      <div class="navbar-collapse-header d-md-none">
        <div class="row">
          <div class="col-6 collapse-brand">
            <a href="{{ route('admin.home') }}">
              <img src="{{ asset('admin') }}/img/brand/blue.png">
            </a>
          </div>
          <div class="col-6 collapse-close">
            <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle sidenav">
              <span></span>
              <span></span>
            </button>
          </div>
        </div>
      </div>
      <!-- Form -->
      <form class="mt-4 mb-3 d-md-none">
        <div class="input-group input-group-rounded input-group-merge">
          <input type="search" class="form-control form-control-rounded form-control-prepended" placeholder="{{ __('Search') }}" aria-label="Search">
          <div class="input-group-prepend">
            <div class="input-group-text">
              <span class="fa fa-search"></span>
            </div>
          </div>
        </div>
      </form>
      <!-- Navigation -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="#navbar-content" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="navbar-content">
            <i class="fas fa-window-restore  text-orange"></i>
            <span class="nav-link-text">Content</span>
          </a>

          <div class="collapse" id="navbar-content">
            <ul class="nav nav-sm flex-column">
              <li class="nav-item">
                <li class="nav-item">
                  <a class="nav-link" href="#navbar-content-blog" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="navbar-content-blog">
                    <i class="fas fa-blog text-blue"></i>
                    <span class="nav-link-text">Blog</span>
                  </a>
                  <div class="collapse" id="navbar-content-blog">
                    <ul class="nav nav-sm flex-column">
                      <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.blog.categories') }}">
                          <i class="fas fa-stream"></i> Categories
                        </a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.blog.posts') }}">
                          <i class="fas fa-paste"></i> Posts
                        </a>
                      </li>
                    </ul>
                  </div>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#navbar-content-video" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="navbar-content-blog">
                    <i class="fas fa-file-video text-blue"></i>
                    <span class="nav-link-text">Videos</span>
                  </a>

                  <div class="collapse" id="navbar-content-video">
                    <ul class="nav nav-sm flex-column">
                      <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.video.categories') }}">
                          <i class="fas fa-stream"></i> Categories
                        </a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.video.posts') }}">
                          <i class="fas fa-video"></i> Videos
                        </a>
                      </li>
                    </ul>
                  </div>
                </li>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.downloads.files') }}">
                  <i class="fas fa-download text-blue"></i>
                  Downloads
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#{{-- {{ route('admin.calendar.show') }} --}}">
                  <i class="fas fa-calendar-alt text-blue"></i>
                  Calendar
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">
                  <i class="fas fa-chart-line text-blue"></i>
                  Market Activity
                </a>
              </li>
            </ul>
          </div>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">
            <i class="fas fa-box text-dark"></i> Orders
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('admin.packages') }}">
            <i class="fas fa-ticket-alt text-dark"></i> Packages
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('admin.users') }}">
            <i class="fas fa-users text-dark"></i> Users
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-dark" href="{{ route('admin.logout') }}">
            <i class="fas fa-sign-out-alt"></i> Logout
          </a>
        </li>
      </ul>
    </div>
  </div>
</nav>
