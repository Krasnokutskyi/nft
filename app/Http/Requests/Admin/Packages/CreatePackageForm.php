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
      'name' => ['required', 'string', 'max:100', 'unique:packages'],
      'price' => ['required', 'numeric', 'min: 0.01'],
      'discount' => ['numeric', 'min: 0', 'lt:price'],
      'content' => ['required', 'array', Rule::in(['videos', 'blog', 'downloads', 'calendar', 'market activity'])],
      'redirect_content' => ['required', 'string', new RedirectContentRule($this->get('content'))],
      'preview' => ['required', 'image'],
      'subtitle' => ['string', 'nullable', 'max:200'],
      'сontent_list' => ['array', 'nullable'],
      'extra_сontent_list' => ['array', 'nullable'],
    ];
  }
}
