<?php

namespace App\Http\Requests\Bill;

use App\Http\Requests\JsonFormRequest;
use LVR\CreditCard\CardCvc;
use LVR\CreditCard\CardNumber;
use LVR\CreditCard\CardExpirationYear;
use LVR\CreditCard\CardExpirationMonth;

class BillForm extends JsonFormRequest
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
      'cardholder_name' => ['required', 'string', 'max: 50'],
      'card_number' => ['required', new CardNumber],
      'expiration_year' => ['required', new CardExpirationYear($this->get('expiration_month'))],
      'expiration_month' => ['required', new CardExpirationMonth($this->get('expiration_year'))],
      'cvv' => ['required', new CardCvc($this->get('card_number'))]
    ];
  }
}