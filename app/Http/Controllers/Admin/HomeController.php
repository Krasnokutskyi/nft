<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\AdminController;
use Illuminate\Http\Request;

class HomeController extends AdminController
{
  public function index(Request $request)
  {
    return redirect(route('admin.blog.posts'));
  }
}
