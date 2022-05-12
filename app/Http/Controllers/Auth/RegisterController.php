<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Auth\RegisterForm;
use App\Http\Requests\Bill\BillForm;
use App\Models\Packages;
use App\Models\Orders;
use App\Models\OrderParameters;
use Dirape\Token\Token;
use Carbon\Carbon;

class RegisterController extends Controller
{
  public function registerAction(RegisterForm $request)
  {
    $validated = $request->safe()->only([
      'first_name', 'last_name', 'phone',
      'email', 'password', 'package',
    ]);

    $validated['phone'] = strval(filter_var($validated['phone'], FILTER_SANITIZE_NUMBER_INT)); 

    $package = Packages::where('id', '=', $validated['package'])->get()->first();
    $price_package = (floatval($package->discount) == 0) ? $package->price : $package->discount;

    $order = Orders::with('parameters')->where('status', '=', '0')->where('end', '>', Carbon::now()->toDateTimeString())->where('token', '=', request()->cookie('order_token'))->get();

    if ($order->count() === 1) {

      $order = $order->first();

      $order->update([
        'amount' => $price_package,
        'end' => Carbon::now()->addHour(6)->toDateTimeString(),
      ]);

      foreach ($validated as $key => $value) {
        if ($key === 'package') { $key = 'package_id'; }
        if ($key === 'password') { $value = bcrypt($value); }
        $order->parameters()->updateParam($key, $value);
      }

      $token = $order->token;

    } else {

      $token = new Token();
      $token = $token->Unique('orders', 'token', 200);

      $order_id = Orders::create([
        'token' => $token,
        'payment_method' => 'fibonatix',
        'amount' => $price_package,
        'type' => 'user_registration',
        'end' => Carbon::now()->addHour(6)->toDateTimeString(),
      ])->id;

      OrderParameters::createParams($order_id, [
        'package_id' => $package->id,
        'first_name' => $validated['first_name'], 
        'last_name' => $validated['last_name'],
        'phone' => $validated['phone'],
        'email' => $validated['email'],
        'password' => bcrypt($validated['password']),
      ]);
    }

    return response()->json([
      'status' => true, 'step'=> 'next'
    ])->cookie('order_token', $token, 6 * 60);
  }

  public function registerActionPay(BillForm $request)
  {
    $validated = $request->safe()->only([
      'cardholder_name', 'card_number', 'expiration_year',
      'expiration_month', 'cvv',
    ]);

    $order = Orders::with('parameters')->where('status', '=', '0')->where('end', '>', Carbon::now()->toDateTimeString())->where('token', '=', request()->cookie('order_token'))->get();

    if ($order->count() === 0) {

      $order = $order->first();
    }

    return response()->json([
      'status' => false, 'step'=> 'next'
    ]);
  }
}
