<?php

namespace App\Rules\Admin\Packages;

use Illuminate\Contracts\Validation\Rule;
use App\Models\Packages;

class UniqueNameRule implements Rule
{
  private int $package_id;

  /**
   * Create a new rule instance.
   *
   * @return void
   */
  public function __construct($package_id)
  {
    $this->package_id = intval($package_id);
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
    $packages = Packages::where('id', '=', $this->package_id)->get();

    if ($packages->count() === 1) {
      if ($packages->first()->name === $value || Packages::where('name', '=', $value)->count() === 0) {
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
