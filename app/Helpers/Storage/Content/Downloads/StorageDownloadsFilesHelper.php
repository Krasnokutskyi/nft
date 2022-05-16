<?php

namespace App\Helpers\Storage\Content\Downloads;

use App\Models\DownloadsFiles as Files;
use Illuminate\Support\Facades\Storage;
use Response;

class StorageDownloadsFilesHelper
{
  public function preview(string $image)
  {
    $files = Files::where('preview', '=', $image);

    if ($files->count() > 0) {

      $file = $files->first();

      $preview_path = 'downloads/preview/' . $file->preview;

      if (Storage::disk('content')->exists($preview_path)) {
        $preview = Storage::disk('content')->get($preview_path);
        $response = Response::make($preview);
        $response->headers->set("Content-Type", Storage::disk('content')->mimeType($preview_path));
        return $response;
      }
    }

    return null;
  }

  public function getInfoAboutPreview($file_id)
  {
    $result = [];

    $file = Files::where('id', '=', $file_id)->get();

    if ($file->count() === 1) {

      $preview_path = 'downloads/preview/' . $file->first()->preview;

      if (Storage::disk('content')->exists($preview_path)) {

        $result[] = [
          'name' => $file->first()->preview,
          'size' => Storage::disk('content')->size($preview_path),
          'type' => Storage::disk('content')->mimeType($preview_path),
          'file' => route('admin.storage.content.downloads.preview', ['image' => $file->first()->preview]),
          'url' => route('admin.storage.content.downloads.preview', ['image' => $file->first()->preview]),
        ];
      }
    }

    return $result;
  }

  public function getInfoAboutFile($file_id)
  {
    $result = [];

    $file = Files::where('id', '=', $file_id)->get();

    if ($file->count() === 1) {

      $file_path = 'downloads/files/' . $file->first()->file;

      if (Storage::disk('content')->exists($file_path)) {

        $result[] = [
          'name' => $file->first()->file,
          'size' => Storage::disk('content')->size($file_path),
          'type' => Storage::disk('content')->mimeType($file_path),
          'file' => route('admin.storage.content.downloads.preview', ['image' => $file->first()->file]),
          'url' => route('admin.storage.content.downloads.preview', ['image' => $file->first()->file]),
        ];
      }
    }

    return $result;
  }
}