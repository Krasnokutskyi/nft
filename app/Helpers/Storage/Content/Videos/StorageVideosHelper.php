<?php

namespace App\Helpers\Storage\Content\Videos;

use App\Helpers\Storage\Content\Videos\StorageVideosPostsHelper;

class StorageVideosHelper
{
  public function posts()
  {
    return new StorageVideosPostsHelper();
  }
}