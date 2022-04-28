<?php

namespace App\Helpers\Access;

use Illuminate\Support\ServiceProvider;

class AccessHelper extends ServiceProvider
{
  public static function getUserAcessContentByPackage(): array
  {
   if (auth('web')->check()) {

      $user_package = auth('web')->user()->packages->first();

      if (is_object($user_package)) {

        $user_content_by_package = explode(',', $user_package->content);

        if (is_array($user_content_by_package)) {
          return $user_content_by_package;
        }
      }
    }

    return [];
  }


  /**
   * Check access to content for user
   * 
   * @param mixed $type Content type
   * 
   * @return bool
   */
  public static function check(mixed $types): bool
  {
    if (!is_array($types)) { $types = array($types); }

    if (auth('web')->check()) {

      foreach ($types as $type) {
        if (in_array(trim(strval($type)), self::getUserAcessContentByPackage(), true)) {
          return true;
        }
      }

    } elseif (auth('admin')->check()) {

      return true;
    }

    return false;
  }
}
