<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Auth\LoginForm;
use App\Helpers\Redirect\RedirectByContentHelper;
use App\Models\User;

class LoginController extends Controller
{
  public function loginAction(LoginForm $request)
  {
    $validated = $request->safe()->only(['email', 'password']);

    if(auth("web")->attempt($validated, true)) {

      $redirect_to = User::with('packages')->find(auth("web")->id())->packages->first()->redirect_content;

      return response()->json([
        'redirect' => RedirectByContentHelper::getPath($redirect_to)
      ]);
    }

    return response()->json([
      'status' => false, 
      'message' => 'Wrong email/password combination.',
      'errors' => ['email' => false, 'password' => false],
    ]);
  }
}
