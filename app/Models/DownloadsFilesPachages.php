<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Packages;

class DownloadsFilesPachages extends Model
{
  use HasFactory;

  protected $fillable = [
    "file_id",
    "package_id",
  ];

  public static function setPackagesByFileId($file_id, array $packages): void
  {
    foreach ($packages as $package_id) {
      self::create([
        'file_id' => $file_id,
        'package_id' => $package_id
      ]);
    }
  }
}
