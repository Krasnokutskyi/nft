<?php

namespace App\Services\Access;

use App\Services\Access\Content\Content;

use Illuminate\Support\ServiceProvider;

class AccessService extends ServiceProvider
{
  public static function content(mixed $content = ''): Content
  {
    return new Content($content);
  }
}
