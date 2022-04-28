<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Packages;
use App\Models\BlogCategoriesPackages;
use App\Models\BlogPosts;
use App\Models\BlogCategoriesPosts;

class BlogCategories extends Model
{
  use HasFactory;

  protected $fillable = [
    "title",
    "alias",
    "access",
  ];

  public function packages()
  {
    return $this->hasManyThrough(Packages::class, BlogCategoriesPackages::class, 'category_id', 'id', 'id', 'package_id');
  }

  public function posts()
  {
    return $this->hasManyThrough(BlogPosts::class, BlogCategoriesPosts::class, 'category_id', 'id', 'id', 'post_id');
  }
}
