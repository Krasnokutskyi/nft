<?php

namespace App\Http\Requests\Admin\Blog;

use App\Http\Requests\JsonFormRequest;
use Illuminate\Validation\Rule;

class CreatePostForm extends JsonFormRequest
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
      'title' => ['required', 'string', 'max:200'],
      'alias' => ['required', 'string', 'max:255', 'regex:/^([0-9a-z]+[-]{1})*[0-9a-z]+$/', 'unique:blog_posts'],
      'text' => ['required', 'string'],
      'categories' => ['array', 'exists:blog_categories,id'],
      'access' => ['required', 'string', Rule::in(['all', 'packages', 'nobody'])], 
      'packages' => ['required_if:access,packages', 'array', 'exists:packages,id'],
      'preview' => ['required', 'image'],
    ];
  }
}
