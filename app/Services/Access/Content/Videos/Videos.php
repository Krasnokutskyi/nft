<?php

namespace App\Services\Access\Content\Videos;

use App\Services\Access\Content\Content;
use App\Models\VideoCategories as Categories;
use App\Models\VideoPosts as Posts;

class Videos
{
  public Content $content;

  function __construct(Content $content)
  {
    $this->content = $content;
  }

  public function isThereAccessToCategory(mixed $category_alias): bool
  {
    $category_alias = strval($category_alias);

    if ($this->content->isThereAccessToContent()) {

      $category = Categories::with('packages')->where('alias', '=', $category_alias)->get();

      if ($category->count() === 1) {

        $category = $category->first();

        if ($category->access === 'all') {
          return true;
        }

        $user = auth('web')->user()->load(['packages']);
        $user_package_id = intval($user->packages->first()->id);

        if ($category->access === 'packages' and $category->packages()->where('package_id', '=', $user_package_id)->count() > 0) {
          return true;
        }
      }
    }

    return false;
  }

  public function isThereAccessToPost(mixed $post_id): bool
  {
    if (auth('admin')->check()) {
      return true;
    }

    $post_id = strval($post_id);

    if ($this->content->isThereAccessToContent()) {
     
      $post = Posts::with('categories')->where('id', '=', $post_id)->get();

      if ($post->count() === 1) {
        
        $post = $post->first();

        if ($post->categories->count() > 0) {
          foreach ($post->categories as $key => $category) {
            if (!$this->isThereAccessToCategory($category->alias)) {
              return false;
            }
          }
        }

        if ($post->access === 'all') {
          return true;
        }

        $user = auth('web')->user()->load(['packages']);
        $user_package_id = intval($user->packages->first()->id);

        if ($post->access === 'packages' and $post->packages()->where('package_id', '=', $user_package_id)->count() > 0) {
          return true;
        }
      }
    }

    return false;
  }
}