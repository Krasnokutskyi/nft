<?php

namespace App\Helpers\Storage\Content\Downloads;

use App\Helpers\Storage\Content\Downloads\StorageDownloadsFilesHelper;

class StorageDownloadsHelper
{
  public function files()
  {
    return new StorageDownloadsFilesHelper();
  }
}