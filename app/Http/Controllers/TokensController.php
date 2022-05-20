<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TokensController extends Controller
{
  public function refreshToken(Request $request)
  {
    return response()->json([
      "csrf_token" => csrf_token(),
    ], 200);
  }
}
