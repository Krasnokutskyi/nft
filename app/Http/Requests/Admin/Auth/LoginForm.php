<?php

namespace App\Http\Requests\Admin\Auth;

use App\Http\Requests\JsonFormRequest;

class LoginForm extends JsonFormRequest
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
      'email' => ['required', 'string', 'email'],
      'password' => ['required', 'string'],
      'remember_me' => ['string']
    ];
  }
}
