<?php

namespace App\Http\Controllers\Admin\Downloads;

use App\Http\Controllers\Admin\AdminController;
use Illuminate\Http\Request;
use App\Models\DownloadsFiles as Files;
use App\Models\Packages;
use App\Http\Requests\Admin\Downloads\UploadFileForm;
use App\Models\DownloadsFilesPachages as FilesPachages;
use App\Models\DownloadsFileTypes as FileTypes;
use App\Http\Requests\Admin\Downloads\EditFileForm;
use Illuminate\Support\Facades\Storage;
use Validator;

class FilesController extends AdminController
{
  public function __construct()
  {
    FileTypes::whereNotIn('id', Files::select('type_id')->get()->toArray())->delete();
  }

  public function files()
  {
    $files = Files::with('type')->orderBy('created_at', 'desc')->paginate(15);
    return view('admin.content.downloads.files', compact('files'));
  }

  public function uploadFile(Request $request)
  {
    $types = FileTypes::orderBy('id', 'desc')->get();
    $packages = Packages::orderBy('id', 'desc')->get();
    return view('admin.content.downloads.upload_file', compact('types', 'packages'));
  }

  public function uploadFileAction(UploadFileForm $request)
  {
    $validated = $request->safe()->only(['title', 'file_type', 'access', 'packages']);

    if (FileTypes::where('title', '=', $validated['file_type'])->count() > 0) {
      $validated['type_id'] = FileTypes::where('title', '=', trim($validated['file_type']))->get()->first()->id;
    } else {
      $validated['type_id'] = FileTypes::create(['title' => trim($validated['file_type'])])->id;
    }
    unset($validated['file_type']);

    $preview = $request->file('preview');
    $validated['preview'] = $preview->hashName();
    $preview->store('downloads/preview', 'content');

    $file = $request->file('file');
    $validated['file'] = $file->hashName();
    $file->store('downloads/files', 'content');

    $file_id = Files::create($validated)->id;

    if ($validated['access'] === 'packages') {
      FilesPachages::setPackagesByFileId($file_id, $validated['packages']);
    }

    return response()->json(['redirect' => route("admin.downloads.files")]);
  }

  public function edit(Request $request)
  {
    $file = Files::with('packages')->where('id', '=', $request->route('file_id'))->get();

    if ($file->count() === 1) {

      $file = $file->first();
      
      $file->file = Files::getFileById($file->id);
      $file->preview = Files::getPreviewFileById($file->id);

      $packages = Packages::orderBy('created_at', 'desc')->get();
      $types = FileTypes::orderBy('created_at', 'desc')->get();

      return view('admin.content.downloads.edit_file', compact('file', 'types', 'packages'));
    }

    abort(404);
  }

  public function editAction(EditFileForm $request)
  {
    $file = Files::where('id', '=', $request->route('file_id'))->get();

    if ($file->count() === 1) {

      $file = $file->first();

      $validated = $request->safe()->only(['title', 'file_type', 'access', 'packages']);

      if (empty($request->file('preview')) and trim($request->get('remote_preview')) === $file->preview) {
        $validator = Validator::make($request->all(), ['preview' => 'required']);
        if ($validator->fails()) {
          return response()->json([
            'status' => false,
            'errors' => $validator->errors(),
          ]);
        }
      } 

      if (empty($request->file('file')) and trim($request->get('remote_file')) === $file->file) {
        $validator = Validator::make($request->all(), ['file' => 'required']);
        if ($validator->fails()) {
          return response()->json([
            'status' => false,
            'errors' => $validator->errors(),
          ]);
        }
      }

      if (!empty($request->file('preview'))) {
        $validated['preview'] = $request->file('preview')->hashName();
        $request->file('preview')->store('downloads/preview', 'content');
        if (Files::where('preview', '=', $file->preview)->count() <= 1) {
          Storage::disk('content')->delete('downloads/preview/' . $file->preview);
        }
      } else {
        $validated['preview'] = $file->preview;
      }

      if (!empty($request->file('file'))) {
        $validated['file'] = $request->file('file')->hashName();
        $request->file('file')->store('downloads/files', 'content');
        if (Files::where('file', '=', $file->file)->count() <= 1) {
          Storage::disk('content')->delete('downloads/files/' . $file->file);
        }
      } else {
        $validated['file'] = $file->file;
      }

      if (FileTypes::where('title', '=', $validated['file_type'])->count() > 0) {
        $validated['type_id'] = FileTypes::where('title', '=', trim($validated['file_type']))->get()->first()->id;
      } else {
        $validated['type_id'] = FileTypes::create(['title' => trim($validated['file_type'])])->id;
      }
      unset($validated['file_type']);

      Files::where('id', $file->id)->update([
        'type_id' => $validated['type_id'],
        'title' => $validated['title'],
        'access' => $validated['access'],
        'preview' => $validated['preview'],
        'file' => $validated['file'],
      ]);

      FilesPachages::where('file_id', $file->id)->delete();
      if ($validated['access'] === 'packages') {
        FilesPachages::setPackagesByFileId($file->id, $validated['packages']);
      }

      return response()->json([
        'status' => true,
        'title' => 'Information has been saved!'
      ]);
    }

    abort(404);
  }

  public function deleteAction(Request $request)
  {
    $file = Files::where('id', '=', $request->route('file_id'));
    if ($file->count() > 0) {
      
      if (Files::where('preview', '=', $file->first()->preview)->count() <= 1) {
        Storage::disk('content')->delete('downloads/preview/' . $file->first()->preview);
      }

      if (Files::where('file', '=', $file->first()->file)->count() <= 1) {
        Storage::disk('content')->delete('downloads/files/' . $file->first()->file);
      }

      $file->delete();

      return response()->json(['result' => true]);
    }

    return response()->json(['result' => false]);
  }
}
