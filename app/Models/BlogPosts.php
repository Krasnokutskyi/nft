<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\BlogCategories;
use App\Models\BlogCategoriesPosts;
use App\Models\Packages;
use App\Models\BlogPostsPackages;

class BlogPosts extends Model
{
  use HasFactory;

  protected $fillable = [
    "preview",
    "title",
    "alias",
    "text",
    "access",
  ];

  public function categories()
  {
   return $this->hasManyThrough(BlogCategories::class, BlogCategoriesPosts::class, 'post_id', 'id', 'id', 'category_id');
  }

  public function packages()
  {
    return $this->hasManyThrough(Packages::class, BlogPostsPackages::class, 'post_id', 'id', 'id', 'package_id');
  }
}
