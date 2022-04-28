<?php

namespace App\Http\Requests\Admin\Packages;

use App\Http\Requests\JsonFormRequest;
use Illuminate\Validation\Rule;
use App\Rules\Admin\Packages\RedirectContentRule;

class CreatePackageForm extends JsonFormRequest
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
      'name' => ['required', 'string', 'max:255', 'unique:packages'],
      'price' => ['required', 'numeric', 'min: 0.01'],
      'content' => ['required', 'array', Rule::in(['videos', 'blog', 'downloads', 'calendar', 'market activity'])],
      'redirect_content' => ['required', 'array', Rule::in(['videos', 'blog', 'downloads', 'calendar', 'market activity']), new RedirectContentRule($this->get('content'))],
    ];
  }
}
