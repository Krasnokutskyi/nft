<?php

namespace App\Http\Requests\Auth;

use App\Http\Requests\JsonFormRequest;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\Rule;
use App\Rules\Auth\PhoneIntoOrderRule;
use App\Rules\Auth\EmailIntoOrderRule;

class RegisterForm extends JsonFormRequest
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
      'phone' => ['required', 'phone:AUTO', 'unique:users', new PhoneIntoOrderRule()],
      'email' => ['required', 'string', 'email', 'max:535', 'unique:users' new EmailIntoOrderRule()],
      'password' => ['required', 'string', Password::min(6)->letters()->numbers()->mixedCase()->uncompromised(), 'max:535', 'confirmed'],
      'password_confirmation' => ['required', 'same:password'],
      'package' => ['required', 'string', 'exists:packages,id']
    ];
  }
}