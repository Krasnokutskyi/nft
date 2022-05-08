<?php

namespace App\Http\Requests\Admin\MarketActivity;

use App\Http\Requests\JsonFormRequest;
use Illuminate\Validation\Rule;

class EditItemForm extends JsonFormRequest
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
      'name' => ['required', 'string', 'max: 535'],
      'volume' => ['required', 'numeric', 'min:0'],
      'shift' => ['required', 'numeric'],
      'floor_price' => ['required', 'numeric', 'min:0'],
      'status' => ['required', 'string', Rule::in(['active', 'deactivated'])],
      'preview' => ['nullable', 'image'],
      'icon_coin' => ['nullable', 'image'],
    ];
  }
}
