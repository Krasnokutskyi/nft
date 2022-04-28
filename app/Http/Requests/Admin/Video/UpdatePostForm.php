<?php

namespace App\Http\Requests\Admin\Video;

use App\Http\Requests\JsonFormRequest;
use Illuminate\Validation\Rule;
use App\Rules\Admin\Video\UpdateAliasPostRule;

class UpdatePostForm extends JsonFormRequest
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
      'video' => ['mimes:mp4,webm,ogv,swf', 'nullable'],
      'categories' => ['array', 'exists:video_categories,id'],
      'access' => ['required', 'string', Rule::in(['all', 'packages', 'nobody'])], 
      'packages' => ['required_if:access,packages', 'array', 'exists:packages,id'],
      'preview' => ['image', 'nullable'],
    ];
  }
}
