<?php

namespace App\Http\Controllers\Admin\Calendar;

use App\Http\Controllers\Admin\AdminController;
use Illuminate\Http\Request;
use App\Models\Calendar;

class CalendarController extends AdminController
{
  public function calendar(Request $request)
  {
    $calendar = Calendar::all();
    return view('admin.content.calendar.calendar', compact('calendar'));
  }

  public function addScheduleAction(Request $request)
  {
    $validated = $request->safe()->only(['title', 'start', 'end', 'category']);
    
  }
}
