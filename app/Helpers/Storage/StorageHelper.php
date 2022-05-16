<?php

namespace App\Helpers\Storage;

use App\Helpers\Storage\Content\Blog\StorageBlogHelper;
use App\Helpers\Storage\Content\Videos\StorageVideosHelper;
use App\Helpers\Storage\Content\Downloads\StorageDownloadsHelper;

class StorageHelper
{
  public static function blog(): StorageBlogHelper
  {
    return new StorageBlogHelper();
  }

  public static function videos(): StorageVideosHelper
  {
    return new StorageVideosHelper();
  }

  public static function downloads(): StorageDownloadsHelper
  {
    return new StorageDownloadsHelper();
  }
}