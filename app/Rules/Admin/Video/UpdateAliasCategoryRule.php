<?php

namespace App\Rules\Admin\Video;

use Illuminate\Contracts\Validation\Rule;
use App\Models\VideoCategories as Categories;

class UpdateAliasCategoryRule implements Rule
{
  private int $category_id;

  /**
   * Create a new rule instance.
   *
   * @return void
   */
  public function __construct($category_id)
  {
    $this->category_id = intval($category_id);
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
    $category = Categories::where('id', '=', $this->category_id)->get();

    if ($category->count() === 1) {
      if ($category->first()->alias === $value || Categories::where('alias', '=', $value)->count() === 0) {
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
