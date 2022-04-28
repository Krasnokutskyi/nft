<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;

class LogoutController extends Controller
{
  public function logout()
  {
    auth("web")->logout();
    return redirect(route("home"));
  }
}