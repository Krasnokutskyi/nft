<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Packages;

class VideoPostsPackages extends Model
{
  use HasFactory;

  protected $fillable = [
    "post_id",
    "package_id",
  ];

  public static function setPackagesByPostId($post_id, array $packages): void
  {
    foreach ($packages as $package_id) {
      self::create([
        'post_id' => $post_id,
        'package_id' => $package_id
      ]);
    }
  }
}
