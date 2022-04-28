<?php

namespace App\Http\Controllers\Admin\Blog;

use App\Http\Controllers\Admin\AdminController;
use Illuminate\Http\Request;
use App\Models\BlogPosts as Posts;
use App\Models\BlogCategories as Categories;
use App\Models\BlogCategoriesPosts as CategoriesPosts;
use App\Models\Packages;
use App\Models\BlogPostsPackages as PostsPackages;
use Validator;
use App\Http\Requests\Admin\Blog\CreatePostForm;
use App\Http\Requests\Admin\Blog\UpdatePostForm;
use Illuminate\Support\Facades\Storage;

class PostsController extends AdminController
{
  public function posts(Request $request)
  {
    $posts = Posts::orderBy('created_at', 'desc')->paginate(15);
    return view('admin.content.blog.posts', compact('posts'));
  }

  public function create(Request $request)
  {
    $categories = Categories::orderBy('created_at', 'desc')->get();
    $packages = Packages::orderBy('created_at', 'desc')->get();
    return view('admin.content.blog.create_post', compact('categories', 'packages'));
  }

  public function createAction(CreatePostForm $request)
  {
    $validated = $request->safe()->only(['title', 'alias', 'text', 'access', 'categories', 'packages']);

    $validated['preview'] = $request->file('preview')->hashName();
    $request->file('preview')->store('blog/preview', 'content');

    $post_id = Posts::create($validated)->id;

    if (array_key_exists('categories', $validated)) {
      CategoriesPosts::setCategoriesByPostId($post_id, $validated['categories']);
    }

    if ($validated['access'] === 'packages') {
      PostsPackages::setPackagesByPostId($post_id, $validated['packages']);
    }

    return response()->json(['redirect' => route("admin.blog.posts")]);
  }

  public function update(Request $request)
  {
    $post = Posts::with(['categories', 'packages'])->where('id', '=', $request->route('post_id'))->get();

    if ($post->count() === 1) {

      $post = $post->first();

      $post->preview = Posts::getPreviewPostById($post->id);

      $categories = Categories::orderBy('created_at', 'desc')->get();
      $packages =  Packages::orderBy('created_at', 'desc')->get();

      return view('admin.content.blog.edit_post', compact('post', 'categories', 'packages'));
    }

    abort(404);
  }

  public function updateAction(UpdatePostForm $request)
  {
    $post = Posts::where('id', '=', $request->route('post_id'))->get();

    if ($post->count() === 1) {

      $post = $post->first();

      $validated = $request->safe()->only(['title', 'alias', 'text', 'access', 'categories', 'packages', 'remote_preview']);

      $preview = $request->file('preview');
      if (!empty($preview))     {
        $validated['preview'] = $preview->hashName();
        $preview->store('blog/preview', 'content');
        if (Posts::where('preview', '=', $post->preview)->count() <= 1) {
          Storage::disk('content')->delete('blog/preview/' . $post->preview);
        }
      } else {
        $validated['preview'] = $post->preview;
        if (trim($request->get('remote_preview')) === $post->preview) {
          $validator = Validator::make($request->all(), ['preview' => 'required']);
          if ($validator->fails()) {
            return response()->json([
              'status' => false,
              'errors' => $validator->errors(),
            ]);
          }
        }
      }

      Posts::where('id', $post->id)->update([
        'title' => $validated['title'],
        'alias'=> $validated['alias'],
        'text' => $validated['text'],
        'access' => $validated['access'],
        'preview' => $validated['preview'],
      ]);

      CategoriesPosts::where('post_id', $post->id)->delete();
      if (array_key_exists('categories', $validated)) {
        CategoriesPosts::setCategoriesByPostId($post->id, $validated['categories']);
      }

      PostsPackages::where('post_id', $post->id)->delete();
      if ($validated['access'] === 'packages') {
        PostsPackages::setPackagesByPostId($post->id, $validated['packages']);
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
    $post = Posts::where('id', '=', $request->route('post_id'));
    if ($post->count() > 0) {
      if (Posts::where('preview', '=', $post->first()->preview)->count() <= 1) {
        Storage::disk('content')->delete('blog/preview/' . $post->first()->preview);
      }
      $post->delete();
      return response()->json(['result' => true]);
    }

    return response()->json(['result' => false]);
  }
}
