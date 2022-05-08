<?php

namespace App\Http\Requests\Admin\Packages;

use App\Http\Requests\JsonFormRequest;
use Illuminate\Validation\Rule;
use App\Rules\Admin\Packages\UniqueNameRule;
use App\Rules\Admin\Packages\RedirectContentRule;

class EditPackageForm extends JsonFormRequest
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
      'name' => ['required', 'string', 'max:100', new UniqueNameRule($this->route('package_id'))],
      'price' => ['required', 'numeric', 'min: 0.01'],
      'discount' => ['numeric', 'min: 0', 'lt:price'],
      'content' => ['required', 'array', Rule::in(['videos', 'blog', 'downloads', 'calendar', 'market activity'])],
      'redirect_content' => ['required', 'string', new RedirectContentRule($this->get('content'))],
      'preview' => ['nullable', 'image'],
      'subtitle' => ['string', 'nullable', 'max:200'],
      'сontent_list' => ['array', 'nullable'],
      'extra_сontent_list' => ['array', 'nullable'],
    ];
  }
}
