<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
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

  public static function getPreviewPostById($post_id)
  {
    $result = [];

    $post = self::where('id', '=', $post_id)->get();

    if ($post->count() === 1) {

      $preview_path = 'blog/preview/' . $post->first()->preview;

      if (Storage::disk('content')->exists($preview_path)) {

        $result[] = [
          'name' => $post->first()->preview,
          'size' => Storage::disk('content')->size($preview_path),
          'type' => Storage::disk('content')->mimeType($preview_path),
          'file' => route('storage.content.blog.preview', ['image' => $post->first()->preview]),
          'url' => route('storage.content.blog.preview', ['image' => $post->first()->preview]),
        ];
      }
    }

    return $result;
  }
}
