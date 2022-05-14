<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\AdminController;
use Illuminate\Http\Request;
use App\Models\Packages;
use App\Http\Requests\Admin\Packages\CreatePackageForm;
use App\Http\Requests\Admin\Packages\EditPackageForm;
use App\Models\BlogCategories;
use App\Models\BlogPosts;
use App\Models\DownloadsFiles;
use App\Models\VideoCategories;
use App\Models\VideoPosts;

class PackagesController extends AdminController
{
  public function packages(Request $request)
  {
    $packages = Packages::with('users')->orderBy('position', 'asc')->get();
    return view('admin.packages.packages', compact('packages'));
  }

  public function create(Request $request)
  {
    return view('admin.packages.create_package');
  }

  public function createAction(CreatePackageForm $request)
  {
    $validated = $request->safe()->only([
      'name', 'price', 'content', 'redirect_content',
      'discount', 'subtitle', 'preview',
      'extra_сontent_list', 'сontent_list',
    ]);

    $validated['preview'] = $request->file('preview')->hashName();
    $request->file('preview')->store('images/packages/preview', 'public');

    $packages_by_position = Packages::orderBy('position', 'desc')->get();
    if ($packages_by_position->count() > 0) {
      $validated['position'] = intval($packages_by_position->first()->position) + 1;
    } else {
      $validated['position'] = 0;
    }

    $validated['content'] = implode(',', $validated['content']);
    $validated['сontent_list'] = (array_key_exists('сontent_list', $validated)) ? implode(',', $validated['сontent_list']) : null;
    $validated['extra_сontent_list'] = (array_key_exists('extra_сontent_list', $validated)) ? implode(',', $validated['extra_сontent_list']): null;

    Packages::create($validated);

    return response()->json(['redirect' => route("admin.packages")]);
  }

  public function edit(Request $request)
  {
    $package = Packages::where('id', '=', $request->route('package_id'));

    if ($package->count() > 0) {

      $package = $package->first();
      $package->content = explode(',', $package->content);
      $package->сontent_list = explode(',', $package->сontent_list);
      $package->extra_сontent_list = explode(',', $package->extra_сontent_list);

      return view('admin.packages.edit_package', compact('package'));
    }

    abort(404);
  }

  public function editAction(EditPackageForm $request)
  {
    $package = Packages::where('id', '=', $request->route('package_id'));

    if ($package->count() > 0) {

      $package = $package->first();

      $validated = $request->safe()->only([
        'name', 'price', 'content', 'redirect_content',
        'discount', 'subtitle', 'preview',
        'extra_сontent_list', 'сontent_list',
      ]);
      
      $preview = $request->file('preview');
      if (!empty($preview))     {
        $validated['preview'] = $preview->hashName();
        $preview->store('images/packages/preview', 'public');
        if (Packages::where('preview', '=', $package->preview)->count() <= 1) {
          Storage::disk('public')->delete('images/packages/preview' . $package->preview);
        }
      } else {
        $validated['preview'] = $package->preview;
        if (trim($request->get('remote_preview')) === $package->preview) {
          $validator = Validator::make($request->all(), ['preview' => 'required']);
          if ($validator->fails()) {
            return response()->json([
              'status' => false,
              'errors' => $validator->errors(),
            ]);
          }
        }
      }

      $validated['content'] = implode(',', $validated['content']);
      $validated['сontent_list'] = (array_key_exists('сontent_list', $validated)) ? implode(',', $validated['сontent_list']) : null;
      $validated['extra_сontent_list'] = (array_key_exists('extra_сontent_list', $validated)) ? implode(',', $validated['extra_сontent_list']): null;

      $package->update($validated);

      return response()->json([
        'status' => true,
        'title' => 'Information has been saved!'
      ]);
    }

    abort(404);
  }

  public function sortableAction(Request $request)
  {
    $old_index = intval($request->get('old_index'));
    $new_index = intval($request->get('new_index'));
    $package_id = intval($request->get('package_id'));
    $position_last_package = Packages::orderBy('position', 'desc')->first()->position;

    Packages::where('id', '=', $package_id)->update(['position' => $new_index]);

    if ($old_index === 0) {
      Packages::where('position', '<=', $new_index)->where('id', '!=', $package_id)->decrement('position', 1);
    } elseif($old_index < $new_index) {
      Packages::where('position', '<=', $new_index)->where('position', '>=', $old_index)->where('id', '!=', $package_id)->decrement('position', 1);
    } elseif ($old_index === $position_last_package) {
      Packages::where('position', '>=', $new_index)->where('id', '!=', $package_id)->increment('position', 1);
    } elseif ($old_index > $new_index) {
      Packages::where('position', '>=', $new_index)->where('position', '<=', $old_index)->where('id', '!=', $package_id)->increment('position', 1);
    }
  }

  public function deleteAction(Request $request)
  {
    $package = Packages::with('users')->where('id', '=', $request->route('package_id'));

    if ($package->count() > 0) {

      $package = $package->first();

      if ($package->users->count() > 0) {
        return response()->json([
          'message' =>'Some users use this package, so it is not possible to remove it.',
          'result' => false,
        ]);
      }

    // BlogCategories::whereHas('packages', function ($query) use ($package_id) {
    //   $query->where('package_id', '=', $package_id);
    // })->update(['access' => 'nobody']);
    //   $package->delete();


      return response()->json(['result' => true]);
    }

    return response()->json(['result' => false]);
  }
}
