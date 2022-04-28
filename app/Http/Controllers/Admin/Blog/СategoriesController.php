<?php

namespace App\Http\Controllers\Admin\Blog;

use App\Http\Controllers\Admin\AdminController;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\Blog\CreateCategoryForm;
use App\Http\Requests\Admin\Blog\UpdateCategoryForm;
use App\Models\BlogCategories as Categories;
use App\Models\Packages;
use App\Models\BlogCategoriesPackages as CategoriesPackages;

class СategoriesController extends AdminController
{
  public function categories(Request $request)
  {
    $categories = Categories::orderBy('created_at', 'desc')->paginate(15);
    return view('admin.content.blog.categories', compact('categories'));
  }

  public function create(Request $request)
  {
    $packages = Packages::all();
    return view('admin.content.blog.create_category', compact('packages'));
  }

  public function createAction(CreateCategoryForm $request)
  {
    $validated = $request->safe()->only(['title', 'alias', 'access']);

    $category_id = Categories::create($validated)->id;

    if ($validated['access'] === 'packages') {
      CategoriesPackages::setPackagesByCategoryId($category_id, $request->get('packages'));
    }

    return response()->json(['redirect' => route("admin.blog.categories")]);
  }

  public function update(Request $request)
  {
    $category = Categories::with('packages')->where('id', '=', $request->route('category_id'))->get();

    if ($category->count() === 1) {

      $category = $category->first();
      $packages = Packages::all();

      return view('admin.content.blog.edit_category', compact('category', 'packages'));
    }

    abort(404);
  }

  public function updateAction(UpdateCategoryForm $request)
  {
    $category = Categories::where('id', '=', $request->route('category_id'))->get();

    if ($category->count() === 1) {

      $category = $category->first();

      $validated = $request->safe()->only(['title', 'alias', 'access']);

      Categories::where('id', $category->id)->update($validated);

      CategoriesPackages::where('id', $category->id)->delete();
      if ($validated['access'] === 'packages') {
        CategoriesPackages::setPackagesByCategoryId($category->id, $request->get('packages'));
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
    $category = Categories::where('id', '=', $request->route('category_id'));

    if ($category->count() > 0) {
      $category->delete();
      return response()->json(['result' => true]);
    }

    return response()->json(['result' => false]);
  }
}
