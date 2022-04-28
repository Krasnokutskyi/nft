<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogCategoriesPosts extends Model
{
  use HasFactory;

  protected $fillable = [
    "post_id",
    "category_id",
  ];

  public static function setCategoriesByPostId($post_id, array $categories): void
  {
    foreach ($categories as $category_id) {
      self::create([
        'category_id' => $category_id,
        'post_id' => $post_id
      ]);
    }
  }
}
