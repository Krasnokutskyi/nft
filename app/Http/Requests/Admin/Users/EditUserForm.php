<?php

namespace App\Http\Requests\Admin\Users;

use App\Http\Requests\JsonFormRequest;
use Illuminate\Validation\Rules\Password;
use App\Rules\Admin\Users\UpdateUserPhoneRule;
use App\Rules\Admin\Users\UpdateUserEmailRule;

class EditUserForm extends JsonFormRequest
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
      'phone' => ['required', 'phone:AUTO', new UpdateUserPhoneRule($this->route('user_id'))],
      'email' => ['required', 'string', 'email', 'max:535', new UpdateUserEmailRule($this->route('user_id'))],
      'package' => ['required', 'string', 'exists:packages,id'],
    ];
  }
}
