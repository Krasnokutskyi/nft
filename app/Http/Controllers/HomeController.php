<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MarketActivity;
use App\Models\Packages;
use App\Models\Orders;

class HomeController extends Controller
{
  public function index(Request $request)
  { 
    $order = Orders::with('parameters')->where('token', '=', request()->cookie('order_token'))->get()->first();
    $packages = Packages::orderBy('position', 'asc')->get();
    $market_activity = MarketActivity::where('status', '=', 'active')->orderBy('position', 'asc')->get();
    return view('home', compact('order', 'packages', 'market_activity'));
  }
}
