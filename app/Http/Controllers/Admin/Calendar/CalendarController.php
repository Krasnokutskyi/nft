<?php

namespace App\Http\Controllers\Admin\Calendar;

use App\Http\Controllers\Admin\AdminController;
use Illuminate\Http\Request;

class CalendarController extends AdminController
{
  public function index(Request $request)
  {
    return view('admin.content.calendar.calendar');
  }
}
