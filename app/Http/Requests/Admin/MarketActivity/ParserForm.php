<?php

namespace App\Http\Requests\Admin\MarketActivity;

use App\Http\Requests\JsonFormRequest;
use Illuminate\Validation\Rule;

class ParserForm extends JsonFormRequest
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
      'resource' => ['required', 'string', Rule::in(['opensea'])],
      'count_raw' => ['required', 'numeric', 'min:1', 'max:100'],
      'status' => ['required', 'string', Rule::in(['active', 'deactivated'])],
    ];
  }
}
