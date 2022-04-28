<?php

namespace App\Http\Requests\Admin\Blog;

use App\Http\Requests\JsonFormRequest;
use Illuminate\Validation\Rule;

class CreateCategoryForm extends JsonFormRequest
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
      'title' => ['required', 'string', 'max:100'],
      'alias' => ['required', 'string', 'max:255', 'regex:/^([0-9a-z]+[-]{1})*[0-9a-z]+$/', 'unique:blog_categories'],
      'access' => ['required', 'string', Rule::in(['all', 'packages', 'nobody'])], 
      'packages' => ['required_if:access,packages', 'array', 'exists:packages,id'],
    ];
  }
}
