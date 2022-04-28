<?php

namespace App\Rules\Admin\Packages;

use Illuminate\Contracts\Validation\Rule;

class RedirectContentRule implements Rule
{
  private array $content;

  /**
   * Create a new rule instance.
   *
   * @return void
   */
  public function __construct($content)
  {
    $this->content = (array($content)) ? $content : [];
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
    if (!is_array($value)) { $value = array($value); }

    foreach ($value as $content) {

      if (!is_string($content) and !is_numeric($content)) {
        return false;
      }

      if (!in_array($content, $this->content, true)) {
        return false;
      }
    }

    return true;

    return false;
  }

  /**
   * Get the validation error message.
   *
   * @return string
   */
  public function message()
  {
    return 'The :attribute is not available.';
  }
}
