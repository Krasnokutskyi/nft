<?php

namespace App\Rules\Admin\Users;

use Illuminate\Contracts\Validation\Rule;
use App\Models\User;

class UpdateUserEmailRule implements Rule
{
  private int $user_id;

  /**
   * Create a new rule instance.
   *
   * @return void
   */
  public function __construct($user_id)
  {
    $this->user_id = intval($user_id);
  }

  /**
   * Determine if the validation rule passes.
   *
   * @param  string  $attribute
   * @param  mixed  $value
   * @return bool
   */
  public function passes($attribute, $value)
  {
    $user = User::where('id', '=', $this->user_id)->get();

    if ($user->count() === 1) {
      if ($user->first()->email === $value || User::where('email', '=', $value)->count() === 0) {
        return true;
      }
    }

    return false;
  }

  /**
   * Get the validation error message.
   *
   * @return string
   */
  public function message()
  {
    return 'The :attribute has already been taken.';
  }
}
