<?php

namespace App\Http\Controllers\Blog;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\BlogPosts as Posts;
use App\Models\BlogCategories as Categories;
use App\Models\BlogCategoriesPosts as CategoriesPosts;
use App\Services\Access\AccessService as Access;
use App\Helpers\Storage\StorageHelper;

class PostsController extends Controller
{
  public function posts(Request $request)
  {
    $categories = Categories::with('posts')->where('access', '!=', 'nobody')->orderBy('created_at', 'desc')->get();

    if (Route::currentRouteName() === 'blog.postsByCategory') {

      $current_category = $categories->where('alias', '=', $request->route('alias'));

      if ($current_category->count() !== 1) {
        abort(404);
      }

      $posts = $current_category->first()->posts()->where('access', '!=', 'nobody')->orderBy('created_at', 'desc')->paginate(8);
      
    } else {

      $posts = Posts::with('categories')->where('access', '!=', 'nobody')->orderBy('created_at', 'desc')->paginate(8);
    }

    return view('content.blog.posts', compact('categories', 'posts'));
  }

  public function post(Request $request)
  {
    $post = Posts::with('categories')->where('alias', '=', $request->route('alias'))->get();

    if ($post->count() === 1) {
      $post = $post->first();
      if (Access::content()->blog()->isThereAccessToPost($post->alias)) {
        $like_posts = Posts::inRandomOrder()->with('categories')->whereNotIn('id', [$post->id])->orderBy('created_at', 'desc')->limit(8)->get();
        return view('content.blog.post', compact('post', 'like_posts'));
      }
    }

    abort(404);
  }

  public function showPostPreview(Request $request)
  { 
    $image = strval($request->route('image'));

    $preview = StorageHelper::blog()->posts()->preview($image);

    if (Posts::where('access', '!=', 'nobody')->where('preview', '=', $image)->count() === 0 or is_null($preview)) {
      abort(404);
    }

    return $preview;
  }
}
