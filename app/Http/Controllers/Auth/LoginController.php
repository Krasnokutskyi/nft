<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Auth\LoginForm;

class LoginController extends Controller
{
  public function loginAction(LoginForm $request)
  {
    $validated = $request->safe()->only(['email', 'password']);

    if(auth("web")->attempt($validated, true)) {
      return response()->json(['redirect' => route("content")]);
    }

    return response()->json([
      'status' => false, 
      'message' => 'Wrong email/password combination.',
      'errors' => ['email' => false, 'password' => false],
    ]);
  }
}
