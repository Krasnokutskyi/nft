<?php

namespace App\Http\Controllers\Admin\Calendar;

use App\Http\Controllers\Admin\AdminController;
use Illuminate\Http\Request;
use App\Models\Calendar;
use App\Http\Requests\Admin\Calendar\AddScheduleForm;
use App\Http\Requests\Admin\Calendar\EditScheduleForm;
use Carbon\Carbon;
use DateTime;

class CalendarController extends AdminController
{
  public function calendar(Request $request)
  {
    $schedules = Calendar::all();
    return view('admin.content.calendar.calendar', compact('schedules'));
  }

  public function addScheduleAction(AddScheduleForm $request)
  {
    $validated = $request->safe()->only([
      'title', 'text', 'is_all_day',
      'bg_color', 'text_color', 'start', 'end'
    ]);

    $validated['start'] = Carbon::createFromTimestamp($validated['start'])->toDateTimeString();
    $validated['end'] = Carbon::createFromTimestamp($validated['end'])->toDateTimeString();

    $schedule_id = Calendar::create($validated)->id;

    return response()->json([
      'status' => true,
      'schedule' => [
        'id' => $schedule_id,
      ],
    ]);
  }

  public function editScheduleAction(EditScheduleForm $request)
  {
    $validated = $request->safe()->only([
      'title', 'text', 'is_all_day',
      'bg_color', 'text_color', 'start', 'end'
    ]);

    $validated['start'] = Carbon::createFromTimestamp($validated['start'])->toDateTimeString();
    $validated['end'] = Carbon::createFromTimestamp($validated['end'])->toDateTimeString();

    Calendar::where('id', '=', intval($request->get('schedule_id')))->update($validated);

    return response()->json(['status' => true]);
  }

  public function deleteScheduleAction(Request $request)
  {
    $schedule = Calendar::where('id', '=', intval($request->get('schedule_id')));
    if ($schedule->count() > 0) {
      $schedule->delete();
      return response()->json(['status' => true]);
    }

    return response()->json(['status' => false]);
  }
}
