<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\VideoPosts;
use App\Models\VideoCategoriesPosts;
use App\Models\Packages;
use App\Models\VideoCategoriesPackages;

class VideoCategories extends Model
{
  use HasFactory;

  protected $fillable = [
    "title",
    "alias",
    "access",
  ];

  public function packages()
  {
    return $this->hasManyThrough(Packages::class, VideoCategoriesPackages::class, 'category_id', 'id', 'id', 'package_id');
  }

  public function posts()
  {
    return $this->hasManyThrough(VideoPosts::class, VideoCategoriesPosts::class, 'post_id', 'id', 'id', 'category_id');
  }
}
