<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Packages;

class BlogCategoriesPackages extends Model
{
  use HasFactory;

  protected $fillable = [
    "category_id",
    "package_id",
  ];

  public static function setPackagesByCategoryId($category_id, array $packages)
  {
    foreach ($packages as $package_id) {
      self::create([
        'category_id' => $category_id,
        'package_id' => $package_id,
      ]);
    }
  }
}
