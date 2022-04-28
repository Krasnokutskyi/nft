<?php

namespace App\Rules\Admin\Blog;

use Illuminate\Contracts\Validation\Rule;
use App\Models\BlogPosts as Posts;

class UpdateAliasPostRule implements Rule
{
  private int $post_id;

  /**
   * Create a new rule instance.
   *
   * @return void
   */
  public function __construct($post_id)
  {
    $this->post_id = intval($post_id);
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
    $post = Posts::where('id', '=', $this->post_id)->get();

    if ($post->count() === 1) {
      if ($post->first()->alias === $value || Posts::where('alias', '=', $value)->count() === 0) {
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
