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
    $this->content = (is_array($content)) ? $content : [$content];
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
    return (in_array($value, $this->content, true)) ? true : false;
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
