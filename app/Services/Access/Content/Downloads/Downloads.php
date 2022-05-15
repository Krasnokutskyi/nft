<?php

namespace App\Services\Access\Content\Downloads;

use App\Services\Access\Content\Content;
use App\Models\DownloadsFiles as Files;

class Downloads
{
  public Content $content;

  function __construct(Content $content)
  {
    $this->content = $content;
  }

  public function isThereAccessToFile(mixed $file_id): bool
  {
    if (auth('admin')->check()) {
      return true;
    }

    $file_id = intval($file_id);

    if ($this->content->isThereAccessToContent()) {
     
      $file = Files::where('id', '=', $file_id)->get();

      if ($file->count() === 1) {
        
        $file = $file->first();

        if ($file->access === 'all') {
          return true;
        }

        $user = auth('web')->user()->load(['packages']);
        $user_package_id = intval($user->packages->first()->id);

        if ($file->access === 'packages' and $file->packages()->where('package_id', '=', $user_package_id)->count() > 0) {
          return true;
        }
      }
    }

    return false;
  }
}