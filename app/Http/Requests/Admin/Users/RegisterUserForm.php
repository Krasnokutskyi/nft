<?php

namespace App\Http\Requests\Admin\Users;

use App\Http\Requests\JsonFormRequest;
use Illuminate\Validation\Rules\Password;

class RegisterUserForm extends JsonFormRequest
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
      'first_name' => ['required', 'string', 'max: 255'],
      'last_name' => ['required', 'string', 'max: 255'],
      'phone' => ['required', 'phone:AUTO', 'unique:users'],
      'email' => ['required', 'string', 'email', 'max:535', 'unique:users'],
      'password' => ['required', 'string', Password::min(6)->letters()->numbers()->mixedCase()->uncompromised(), 'max:535', 'confirmed'],
      'package' => ['required', 'string', 'exists:packages,id'],
    ];
  }
}
