<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MarketActivity;
use App\Models\Orders;

class HomeController extends Controller
{
  public function index(Request $request)
  { 
    $order = Orders::with('parameters')->where('token', '=', request()->cookie('order_token'))->get()->first();
    $market_activity = MarketActivity::where('status', '=', 'active')->orderBy('position', 'asc')->get();
    return view('home', compact('order', 'market_activity'));
  }
}
