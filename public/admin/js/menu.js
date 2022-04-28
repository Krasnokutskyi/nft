document.addEventListener("DOMContentLoaded", () => {
  if (name_route !== undefined && name_route !== null) {
    switch (name_route) {
      case 'admin.blog.categories':
      case 'admin.blog.posts':
        $('.menu .navbar-nav .nav-item:eq(0) a').addClass('active');
        $('.menu .navbar-nav .nav-item:eq(0) > .collapse').addClass('show');
        $('.menu .navbar-nav .nav-item:eq(0) .nav .nav-item:eq(0) a').addClass('active');
        $('.menu .navbar-nav .nav-item:eq(0) .nav .nav-item:eq(1) > .collapse').addClass('show');
        break;
    }
  }
});