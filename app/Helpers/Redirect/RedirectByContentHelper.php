<?php

namespace App\Helpers\Redirect;

use Illuminate\Support\ServiceProvider;

class RedirectByContentHelper extends ServiceProvider
{
  public static function getPath($type_content)
  {
    switch ($type_content) {
      case 'videos':
        return route('videos.posts');
        break;
      
      case 'blog':
        return route('blog.posts');
        break;

      case 'downloads':
        return route('downloads.files');
        break;

      case 'calendar':
        return route('calendar');
        break;

      case 'market activity':
        return route('marketActivity');
        break;
    }

    return '';
  }
}
