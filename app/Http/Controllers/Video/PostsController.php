<?php

namespace App\Http\Controllers\Video;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\VideoPosts as Posts;
use App\Models\VideoCategories as Categories;
use App\Models\VideoCategoriesPosts as CategoriesPosts;
use Illuminate\Support\Facades\Storage;
use Response;
use App\Helpers\Access\AccessVideosCategoryHelper;
use getID3;
use Route;
use App\Services\Access\AccessService as Access;

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
    $posts = Posts::where('video', '=', strval($request->route('video')));
    if ($posts->count() > 0) {
      if (Access::content()->videos()->isThereAccessToPost($post->first()->id)) {
        $video_path = 'video/' . $posts->first()->video;
        if (Storage::disk('content')->exists($video_path)) {
          $video = Storage::disk('content')->get($video_path);
          $response = Response::make($video);
          $response->header("Content-Type", Storage::disk('content')->mimeType($video_path));
          return $response;
        }
      }
    } 

    abort(404);
  }

  public function showVideoPreview(Request $request)
  {
    $post = Posts::where('preview', '=', strval($request->route('image')));

    if ($post->count() > 0) {
      $preview_path = 'video/preview/' . $post->first()->preview;
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
