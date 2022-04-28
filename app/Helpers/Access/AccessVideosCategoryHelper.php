<?php

namespace App\Helpers\Access;

use App\Helpers\Access;
use App\Models\VideoCategories as Categories;

class AccessVideosCategoryHelper extends Access
{
  public function check($category_id): bool
  {
    $category = Categories::with('packages')->where('id', '=', $category_id)->get();

    if ($category->count() === 1) {
      
      $category = $category->first();

      if ($category->access === 'all') {

        return parent::check('videos');

      } elseif($category->access === 'packages' and auth('web')->check()) {

        $user_package = auth('web')->user()->packages->first();

        if ($category->packages->where('id', '=', $user_package->id)->count() === 1) {
          return parent::check('videos');
        }
      }
    }

    return false;
  }
}
