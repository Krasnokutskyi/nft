<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Admin\AdminController;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\Auth\LoginForm;

class LoginController extends AdminController
{
  public function login()
  {
    return view("admin.auth.login");
  }

  public function loginAction(LoginForm $request)
  {
    $validated = $request->safe()->only(['email', 'password']);

    $remember_me = filter_var($request->get('remember_me'), FILTER_VALIDATE_BOOL);

    if(auth("admin")->attempt($validated, $remember_me)) {
      return response()->json(['redirect' => route("admin.home")]);
    }

    return response()->json([
      'status' => false, 
      'message' => 'Wrong email/password combination.',
      'errors' => ['email' => false, 'password' => false],
    ]);
  }

  public function logout()
  {
    auth("admin")->logout();
    return redirect(route("home"));
  }
}
