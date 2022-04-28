<?php

namespace App\Http\Requests\Auth;

use App\Http\Requests\JsonFormRequest;
use Illuminate\Validation\Rules\Password;
use LVR\CreditCard\CardCvc;
use LVR\CreditCard\CardNumber;
use LVR\CreditCard\CardExpirationYear;
use LVR\CreditCard\CardExpirationMonth;
use Illuminate\Validation\Rule;

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
      'phone' => ['required', 'phone:AUTO', 'unique:users'],
      'email' => ['required', 'string', 'email', 'max:535', 'unique:users'],
      'password' => ['required', 'string', Password::min(6)->letters()->numbers()->mixedCase()->uncompromised(), 'max:535', 'confirmed'],
      'password_confirmation' => ['required', 'same:password'],
      // 'package' => ['required', 'string', 'exists:packages,id'],
      'cardholder_name' => ['required', 'string', 'max: 50'],
      'card_number' => ['required', new CardNumber],
      'expiration_year' => ['required', new CardExpirationYear($this->get('expiration_month'))],
      'expiration_month' => ['required', new CardExpirationMonth($this->get('expiration_year'))],
      'cvv' => ['required', new CardCvc($this->get('card_number'))],
    ];
  }
}