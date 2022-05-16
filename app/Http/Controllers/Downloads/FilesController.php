<?php

namespace App\Http\Controllers\Downloads;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DownloadsFiles as Files;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Services\Access\AccessService as Access;
use App\Helpers\Storage\StorageHelper;
use ZipArchive;
use Response;

class FilesController extends Controller
{
  public function files(Request $request)
  {
    $files = Files::with('type')->where('access', '!=', 'nobody')->orderBy('created_at', 'desc')->paginate(7);
    return view('content.downloads.files', compact('files'));
  }

  public function downloadFile(Request $request)
  {
    $files = Files::where('access', '!=', 'nobody')->where('file', '=', strval($request->route('file')));

    if ($files->count() > 0) {
      if (Access::content()->downloads()->isThereAccessToFile($files->first()->id)) {

        $file = $files->first();

        $file_path = 'downloads/files/' . $file->file;

        if (Storage::disk('content')->exists($file_path)) {
          $download_file = Storage::disk('content')->path($file_path);
          $new_name = $file->title . '.' . pathinfo($download_file, PATHINFO_EXTENSION);
          return Response::download($download_file, $new_name);
        }
      }
    }

    abort(404);
  }

  public function downloadAllFiles(Request $request)
  {
    $files = Files::where('access', '!=', 'nobody')->get();

    if ($files->count() > 0) {

      $zip = new ZipArchive();
      $zipFile = Storage::disk('content')->path('downloads/' . Str::random(20) . '.zip');

      if ($zip->open($zipFile, ZipArchive::CREATE) === TRUE) {

        foreach ($files as $key => $file) {

          if (!Access::content()->downloads()->isThereAccessToFile($file->id)) {
            continue;
          }

          $file_path = 'downloads/files/' . $file->file;
          if (Storage::disk('content')->exists($file_path)) {
            $download_file = Storage::disk('content')->path($file_path);
            $new_name = $file->title . '.' . pathinfo($download_file, PATHINFO_EXTENSION);
            $zip->addFile($download_file, $new_name);
          }
        }

        $zip->close();

        return response()->download($zipFile)->deleteFileAfterSend(true);
      }
    }

    abort(404);
  }

  public function showFilePreview(Request $request)
  {
    $image = strval($request->route('image'));

    $preview = StorageHelper::downloads()->files()->preview($image);

    if (Files::where('access', '!=', 'nobody')->where('preview', '=', $image)->count() === 0 or is_null($preview)) {
      abort(404);
    }

    return $preview;
  }
}
