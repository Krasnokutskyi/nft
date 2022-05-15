<?php

namespace App\Rules\Orders;

use Illuminate\Contracts\Validation\Rule;

class CurrentUserPackageRule implements Rule
{
  /**
   * Determine if the validation rule passes.
   *
   * @param  string  $attribute
   * @param  mixed  $value
   * @return bool
   */
  public function passes($attribute, $value)
  {
    $value = strval($value);

    if (auth('web')->check()) {

      $user = auth('web')->user()->load(['packages']);

      if ($user->packages->where('id', '=', $value)->count() === 0) {
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
    return 'You are already using this package.';
  }
}
