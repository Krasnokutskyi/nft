<?php

namespace App\Http\Controllers\MarketActivity;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MarketActivity;
use App\Services\Access\AccessService as Access;

class MarketActivityController extends Controller
{
  public function index()
  {
    if (Access::content('market activity')->isThereAccessToContent()) {
      $market_activity = MarketActivity::where('status', '=', 'active')->orderBy('position', 'asc')->get();
      return view('content.market.index', compact('market_activity'));
    }

    abort(404);
  }
}
