<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use App\Models\DownloadsFilesPachages;
use App\Models\DownloadsFileTypes;

class DownloadsFiles extends Model
{
  use HasFactory;

  protected $fillable = [
    "type_id",
    "preview",
    "file",
    "title",
    "access",
  ];

  public function packages()
  {
    return $this->hasManyThrough(Packages::class, DownloadsFilesPachages::class, 'file_id', 'id', 'id', 'package_id');
  }

  public function type()
  {
    return $this->hasMany(DownloadsFileTypes::class, 'id', 'type_id');
  }
}
