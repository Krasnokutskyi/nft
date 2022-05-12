<?php

namespace App\Http\Controllers\Calendar;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Calendar;

class CalendarController extends Controller
{
  public function calendar(Request $request)
  {
    $schedules = Calendar::all();
    return view('content.calendar.index', compact('schedules'));
  }
}
