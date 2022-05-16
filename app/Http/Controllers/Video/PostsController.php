<?php

namespace App\Http\Controllers\Video;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\VideoPosts as Posts;
use App\Models\VideoCategories as Categories;
use App\Models\VideoCategoriesPosts as CategoriesPosts;
use Illuminate\Support\Facades\Storage;
use App\Helpers\Access\AccessVideosCategoryHelper;
use App\Services\Access\AccessService as Access;
use App\Helpers\Storage\StorageHelper;
use getID3;
use Route;

class PostsController extends Controller
{
  public function posts(Request $request)
  {
    $categories = Categories::with('posts')->where('access', '!=', 'nobody')->orderBy('created_at', 'desc')->get();

    if (Route::currentRouteName() === 'videos.postsByCategory') {

      $current_category = $categories->where('alias', '=', $request->route('alias'));

      if ($current_category->count() === 0) {
        abort(404);
      }

      $posts = $current_category->first()->posts()->where('access', '!=', 'nobody')->orderBy('created_at', 'desc')->paginate(8);

    } else {

      $posts = Posts::with('categories')->where('access', '!=', 'nobody')->orderBy('created_at', 'desc')->paginate(8);
    }

    foreach ($posts as $key => &$post) {
      $getID3 = new getID3;
      $video = $getID3->analyze(Storage::disk('content')->path('video/' . $post->video));
      $post->playtime = (array_key_exists('playtime_string', $video)) ? $video['playtime_string'] : '';
    }

    return view('content.videos.posts', compact('categories', 'posts'));
  }

  public function showVideo(Request $request)
  {
    $video = strval($request->route('video'));

    $post = Posts::where('access', '!=', 'nobody')->where('video', '=', $video);

    if ($post->count() > 0) {
      if (Access::content()->videos()->isThereAccessToPost($post->first()->id)) {

        $video = StorageHelper::videos()->posts()->video($video);

        if (!is_null($video)) {
          return $video;
        }
      }
    }


    abort(404);
  }

  public function showVideoPreview(Request $request)
  {
    $image = strval($request->route('image'));

    $preview = StorageHelper::videos()->posts()->preview($image);

    if (Posts::where('access', '!=', 'nobody')->where('preview', '=', $image)->count() === 0 or is_null($preview)) {
      abort(404);
    }

    return $preview;
  }
}
