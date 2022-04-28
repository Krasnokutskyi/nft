<?php

namespace App\Http\Requests\Admin\Packages;

use App\Http\Requests\JsonFormRequest;

class SortablePackagesForm extends JsonFormRequest
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
   * @return array
   */
  public function rules()
  {
    return [
      'new_index' => ['required', 'numeric', 'exists:packages,position'],
      'old_index' => ['required', 'numeric', 'exists:packages,position'],
      'package_id' => ['required', 'numeric', 'exists:packages,id'],
    ];
  }
}
