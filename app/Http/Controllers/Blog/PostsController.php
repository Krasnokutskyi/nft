<?php

namespace App\Http\Controllers\Blog;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\BlogPosts as Posts;
use App\Models\BlogCategories as Categories;
use App\Models\BlogCategoriesPosts as CategoriesPosts;
use Illuminate\Support\Facades\Storage;
use Response;

class PostsController extends Controller
{
  public function posts(Request $request)
  {
    $categories = Categories::orderBy('created_at', 'desc')->get();

    if (Route::currentRouteName() === 'blog.postsByCategory') {

      $current_category = $categories->where('alias', '=', $request->route('alias'));

      if ($current_category->count() !== 1) {
        abort(404);
      }

      $posts = $current_category->first()->posts()->orderBy('created_at', 'desc')->paginate(8);
      
    } else {

      $posts = Posts::with('categories')->orderBy('created_at', 'desc')->paginate(8);
    }

    return view('content.blog.posts', compact('categories', 'posts'));
  }

  public function post(Request $request)
  {
    $post = Posts::with('categories')->where('alias', '=', $request->route('alias'))->get();

    if ($post->count() === 1) {
      $post = $post->first();
      $like_posts = Posts::inRandomOrder()->with('categories')->whereNotIn('id', [$post->id])->orderBy('created_at', 'desc')->limit(8)->get();
      return view('content.blog.post', compact('post', 'like_posts'));
    }

    abort(404);
  }

  public function showPostPreview(Request $request)
  {

    $posts = Posts::where('preview', '=', strval($request->route('image')));

    if ($posts->count() > 0) {
      $preview_path = 'blog/preview/' . $posts->first()->preview;
      if (Storage::disk('content')->exists($preview_path)) {
        $preview = Storage::disk('content')->get($preview_path);
        $response = Response::make($preview);
        $response->header("Content-Type", Storage::disk('content')->mimeType($preview_path));
        return $response;
      }
    }

    abort(404);
  }
}
