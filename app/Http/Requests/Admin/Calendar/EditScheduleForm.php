<?php

namespace App\Http\Requests\Admin\Calendar;

use App\Http\Requests\JsonFormRequest;

class EditScheduleForm extends JsonFormRequest
{
  /**
   * Determine if the user is authorized to make this request.
   *
   * @return bool
   */
  public function authorize()
  {
    return true;
  }

  /**
   * Get the validation rules that apply to the request.
   *
   * @return array<string, mixed>
   */
  public function rules()
  {
    return [
      'schedule_id' => ['required', 'exists:calendar,id'],
      'title' => ['required', 'string', 'max:535'],
      'text' => ['required', 'string'],
      'is_all_day' => ['required', 'boolean'],
      'bg_color' => ['required', 'string', 'max:50', 'color'],
      'text_color' => ['required', 'string', 'max:50', 'color'],
      'start' => ['required', 'string'],
      'end' => ['required', 'string'],
    ];
  }
}
