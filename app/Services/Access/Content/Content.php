<?php

namespace App\Services\Access\Content;

use App\Services\Access\Content\Blog\Blog;
use App\Services\Access\Content\Downloads\Downloads;
use App\Services\Access\Content\Videos\Videos;

class Content
{
  private string $content;

  public function __construct(mixed $content = '')
  {
    $this->content = strval($content);
  }

  public function isThereAccessToContent(mixed $content = null): bool
  {
    $content = (is_null($content)) ? $this->content : strval($content);

    if (auth('web')->check()) {

      $user = auth('web')->user()->load(['packages']);

      if ($user->packages()->whereRaw('FIND_IN_SET(?, `content`)', [$content])->count() === 1) {
        return true;
      }
    }

    return false;
  }

  public function blog()
  {
    return new Blog(new Content('blog'));
  }

  public function downloads()
  {
    return new Downloads(new Content('downloads'));
  }

  public function videos()
  {
    return new Videos(new Content('downloads'));
  }
}
