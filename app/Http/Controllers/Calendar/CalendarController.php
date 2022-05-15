<?php

namespace App\Http\Controllers\Calendar;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Calendar;
use App\Services\Access\AccessService as Access;

class CalendarController extends Controller
{
  public function calendar(Request $request)
  {
    if (Access::content('calendar')->isThereAccessToContent()) {
      $schedules = Calendar::all();
      return view('content.calendar.index', compact('schedules'));
    }

    abort(404);
  }
}
