<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\VideoCategories;
use App\Models\VideoCategoriesPosts;
use App\Models\Packages;
use App\Models\VideoPostsPackages;

class VideoPosts extends Model
{
  use HasFactory;

  protected $fillable = [
    "title",
    "preview",
    "video",
    "access",
  ];

  public function categories()
  {
   return $this->hasManyThrough(VideoCategories::class, VideoCategoriesPosts::class, 'post_id', 'id', 'id', 'category_id');
  }

  public function packages()
  {
    return $this->hasManyThrough(Packages::class, VideoPostsPackages::class, 'post_id', 'id', 'id', 'package_id');
  }
}
