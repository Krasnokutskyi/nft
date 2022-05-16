<?php

namespace App\Services\Access\Content\Blog;

use App\Services\Access\Content\Content;
use App\Models\BlogCategories as Categories;
use App\Models\BlogPosts as Posts;

class Blog
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

  public function isThereAccessToPost(mixed $post_alias): bool
  {
    $post_alias = strval($post_alias);

    if ($this->content->isThereAccessToContent()) {
     
      $post = Posts::with('categories')->where('alias', '=', $post_alias)->get();

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