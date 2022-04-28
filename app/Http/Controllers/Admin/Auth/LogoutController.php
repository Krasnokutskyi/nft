<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Admin\AdminController;

class LogoutController extends AdminController
{
  public function logout()
  {
    auth("admin")->logout();
    return redirect(route("admin.login"));
  }
}