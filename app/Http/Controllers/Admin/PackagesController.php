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
    $packages = Packages::orderBy('position', 'asc')->get();
    return view('admin.packages.packages', compact('packages'));
  }

  public function create(Request $request)
  {
    return view('admin.packages.create_package');
  }

  public function createAction(CreatePackageForm $request)
  {
    $validated = $request->safe()->only([
      'name', 'price', 'content'
    ]);

    $validated['position'] = intval(Packages::orderBy('position', 'desc')->first()->position) + 1;
    $validated['content'] = implode(',', $validated['content']);

    Packages::create($validated);

    return response()->json(['redirect' => route("admin.packages")]);
  }

  public function edit(Request $request)
  {
    $package = Packages::where('id', '=', $request->route('package_id'));

    if ($package->count() > 0) {

      $package = $package->first();
      $package->content = explode(',', $package->content);

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
        'name', 'price', 'content'
      ]);

      $validated['content'] = implode(',', $validated['content']);

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

    Packages::where('position', '=', $old_index)->where('id', '=', $package_id)->update(['position' => $new_index]);

    if ($old_index === 0) {
      Packages::where('position', '<=', $new_index)->where('id', '!=', $package_id)->decrement('position', 1);
    } elseif ($new_index === $position_last_package) {
      Packages::where('position', '>=', $new_index)->where('id', '!=', $package_id)->increment('position', 1);
    } else {
      Packages::where('position', '=', $new_index)->where('id', '!=', $package_id)->update(['position' => $old_index]);
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
