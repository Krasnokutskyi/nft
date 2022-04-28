<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Packages;

class VideoCategoriesPackages extends Model
{
  use HasFactory;

  protected $fillable = [
    "category_id",
    "package_id",
  ];

  public static function setPackagesById($category_id, array $packages): void
  {
    foreach ($packages as $key => $value) {
      $packages[$key] = [ 
        'category_id' => $category_id,
        'package_id' => $value,
        'created_at' => now(),
        'updated_at' => now(),
      ];
    }

    self::insert($packages);
  }
}
