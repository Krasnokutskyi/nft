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

  public static function getPreviewFileById($file_id)
  {
    $result = [];

    $file = self::where('id', '=', $file_id)->get();

    if ($file->count() === 1) {

      $preview_path = 'downloads/preview/' . $file->first()->preview;

      if (Storage::disk('content')->exists($preview_path)) {

        $result[] = [
          'name' => $file->first()->preview,
          'size' => Storage::disk('content')->size($preview_path),
          'type' => Storage::disk('content')->mimeType($preview_path),
          'file' => route('storage.content.downloads.preview', ['image' => $file->first()->preview]),
          'url' => route('storage.content.downloads.preview', ['image' => $file->first()->preview]),
        ];
      }
    }

    return $result;
  }

  public static function getFileById($file_id)
  {
    $result = [];

    $file = self::where('id', '=', $file_id)->get();

    if ($file->count() === 1) {

      $file_path = 'downloads/files/' . $file->first()->file;

      if (Storage::disk('content')->exists($file_path)) {

        $result[] = [
          'name' => $file->first()->file,
          'size' => Storage::disk('content')->size($file_path),
          'type' => Storage::disk('content')->mimeType($file_path),
          'file' => route('storage.content.downloads.preview', ['image' => $file->first()->file]),
          'url' => route('storage.content.downloads.preview', ['image' => $file->first()->file]),
        ];
      }
    }

    return $result;
  }
}
