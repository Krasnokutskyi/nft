<?php

namespace App\Helpers\Storage\Content\Blog;

use App\Helpers\Storage\Content\Blog\StorageBlogPostsHelper;

class StorageBlogHelper
{
  public function posts()
  {
    return new StorageBlogPostsHelper();
  }
}