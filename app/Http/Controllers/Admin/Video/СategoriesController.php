<?php

namespace App\Http\Controllers\Admin\Video;

use App\Http\Controllers\Admin\AdminController;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\Video\CreateCategoryForm;
use App\Http\Requests\Admin\Video\UpdateCategoryForm;
use App\Models\VideoCategories as Categories;
use App\Models\Packages;
use App\Models\VideoCategoriesPackages as CategoriesPackages;

class СategoriesController extends AdminController
{
  public function categories(Request $request)
  {
    $categories = Categories::orderBy('id', 'desc')->paginate(15);
    return view('admin.content.video.categories', compact('categories'));
  }

  public function create(Request $request)
  {
    $packages = Packages::all();
    return view('admin.content.video.create_category', compact('packages'));
  }

  public function createAction(CreateCategoryForm $request)
  {
    $validated = $request->safe()->only(['title', 'alias', 'access']);

    $category_id = Categories::create($validated)->id;

    if ($validated['access'] === 'packages') {
      CategoriesPackages::setPackagesById($category_id, $request->get('packages'));
    }

    return response()->json(['redirect' => route("admin.video.categories")]);
  }

  public function update(Request $request)
  {
    $category = Categories::where('id', '=', $request->route('category_id'))->get();

    if ($category->count() === 1) {

      $category = $category->first();
      $packages = Packages::all();

      return view('admin.content.video.edit_category', compact('category', 'packages'));
    }

    abort(404);
  }

  public function updateAction(UpdateCategoryForm $request)
  {
    $category = Categories::with('packages')->where('id', '=', $request->route('category_id'))->get();

    if ($category->count() === 1) {

      $category = $category->first();

      $validated = $request->safe()->only(['title', 'alias', 'access']);
      $category->update($validated);

      CategoriesPackages::where('category_id', '=', $category->id)->delete();
      if ($validated['access'] === 'packages') {
        CategoriesPackages::setPackagesById($category->id, $request->get('packages'));
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
    $categories = Categories::where('id', '=', $request->route('category_id'));

    if ($categories->count() > 0) {
      $categories->delete();
      return response()->json(['result' => true]);
    }

    return response()->json(['result' => false]);
  }
}