<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Auth\RegisterForm;

class RegisterController extends Controller
{
  public function registerAction(RegisterForm $request)
  {
    $validated = $request->safe()->only([
      'first_name', 'last_name', 'phone',
      'email', 'password', 'package',
      'cardholder_name', 'card_number', 'expiration_year',
      'expiration_month', 'cvv',
    ]);

    return response()->json(['wait' => true, 'watch'=> route('registerAction')]);;
  }
}
