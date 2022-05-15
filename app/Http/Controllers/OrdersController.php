<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\Orders\ChangePackageForm;
use App\Models\Packages;
use Carbon\Carbon;
use App\Models\Orders;
use App\Models\OrderParameters;
use Dirape\Token\Token;
use App\Models\UserPackages;

class OrdersController extends Controller
{
  public function changePackageAction(ChangePackageForm $request)
  {
    if (auth('web')->check()) {

      $validated = $request->safe()->only([
        'cardholder_name', 'card_number', 'expiration_year',
        'expiration_month', 'cvv', 'package',
      ]);

      $package = Packages::where('id', '=', $request->get('package'))->get()->first();
      $price_package = (floatval($package->discount) == 0) ? $package->price : $package->discount;

      $token = new Token();
      $token = $token->Unique('orders', 'token', 200);

      $order_id = Orders::create([
        'token' => $token,
        'payment_method' => 'fibonatix',
        'amount' => $price_package,
        'type' => 'change_package',
        'end' => Carbon::now()->addHour(6)->toDateTimeString(),
      ])->id;

      OrderParameters::createParams($order_id, [
        'package_id' => $package->id,
        'user_id' => auth('web')->user()->id,
      ]);

      // Test
      UserPackages::where('user_id', '=', auth('web')->user()->id)->update([
        'package_id' => $package->id,
      ]);

      return response()->json([
        'status' => true, 'step'=> 'next'
      ]);
    }

    abort(404);
  }
}
