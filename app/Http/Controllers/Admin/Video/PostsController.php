<?php

namespace App\Http\Controllers\Admin\Video;

use App\Http\Controllers\Admin\AdminController;
use Illuminate\Http\Request;
use App\Models\VideoPosts as Posts;
use App\Models\VideoCategories as Categories;
use App\Models\VideoCategoriesPosts as CategoriesPosts;
use App\Models\Packages;
use App\Models\VideoPostsPackages as PostsPackages;
use Validator;
use App\Http\Requests\Admin\Video\CreatePostForm;
use App\Http\Requests\Admin\Video\UpdatePostForm;
use Illuminate\Support\Facades\Storage;
use App\Helpers\Storage\StorageHelper;

class PostsController extends AdminController
{
  public function posts(Request $request)
  {
    $posts = Posts::orderBy('created_at', 'desc')->paginate(15);
    return view('admin.content.video.posts', compact('posts'));
  }

  public function create(Request $request)
  {
    $categories = Categories::all();
    $packages = Packages::all();
    return view('admin.content.video.add_video', compact('categories', 'packages'));
  }

  public function createAction(CreatePostForm $request)
  {
    $validated = $request->safe()->only(['title', 'access']);

    $validated['preview'] = basename($request->file('preview')->store('video/preview', 'content'));
    $validated['video'] = basename($request->file('video')->store('video', 'content'));

    $post_id = Posts::create($validated)->id;

    if (is_array($request->get('categories'))) {
      CategoriesPosts::setCategoriesByPostId($post_id, $request->get('categories'));
    }

    if ($validated['access'] === 'packages') {
      PostsPackages::setPackagesByPostId($post_id, $request->get('packages'));
    }

    return response()->json(['redirect' => route("admin.video.posts")]);
  }

  public function update(Request $request)
  {
    $post = Posts::with('packages', 'categories')->where('id', '=', $request->route('post_id'))->get();

    if ($post->count() === 1) {

      $post = $post->first();
      $post->video = StorageHelper::videos()->posts()->getInfoAboutVideo($post->id);
      $post->preview = StorageHelper::videos()->posts()->getInfoAboutPreviewVideo($post->id);
      $categories = Categories::all();
      $packages = Packages::all();

      return view('admin.content.video.edit_video', compact('post', 'packages', 'categories'));
    }

    abort(404);
  }

  public function updateAction(UpdatePostForm $request)
  {
    $post = Posts::where('id', '=', $request->route('post_id'))->get();

    if ($post->count() === 1) {

      $post = $post->first();

      $validated = $request->safe()->only(['title', 'access']);

      if (empty($request->file('preview')) and $request->get('remote_preview') === $post->preview) {
        $validator = Validator::make($request->all(), ['preview' => 'required']);
        if ($validator->fails()) {
          return response()->json([
            'status' => false,
            'errors' => $validator->errors(),
          ]);
        }
      } 

      if (empty($request->file('video')) and $request->get('remote_video') === $post->video) {
        $validator = Validator::make($request->all(), ['video' => 'required']);
        if ($validator->fails()) {
          return response()->json([
            'status' => false,
            'errors' => $validator->errors(),
          ]);
        }
      }

      if (!empty($request->file('preview'))) {
        $validated['preview'] = $request->file('preview')->hashName();
        $request->file('preview')->store('video/preview', 'content');
        if (Posts::where('preview', '=', $post->preview)->count() <= 1) {
          Storage::disk('content')->delete('video/preview/' . $post->preview);
        }
      } else {
        $validated['preview'] = $post->preview;
      }

      if (!empty($request->file('video'))) {
        $validated['video'] = $request->file('video')->hashName();
        $request->file('video')->store('video', 'content');
        if (Posts::where('video', '=', $post->video)->count() <= 1) {
          Storage::disk('content')->delete('video' . $post->video);
        }
      } else {
        $validated['video'] = $post->video;
      }

      Posts::where('id', $post->id)->update($validated);

      CategoriesPosts::where('post_id', $post->id)->delete();
      if (is_array($request->get('categories'))) {
        CategoriesPosts::setCategoriesByPostId($post->id, $request->get('categories'));
      }

      PostsPackages::where('post_id', $post->id)->delete();
      if ($validated['access'] === 'packages') {
        PostsPackages::setPackagesByPostId($post->id, $request->get('packages'));
      }

      return response()->json([
        'status' => true,
        'title' => 'Information has been saved!',
      ]);
    }

    abort(404);
  }

  public function deleteAction(Request $request)
  {
    $post_id = $request->route('post_id');

    $post = Posts::where('id', '=', $post_id);

    if ($post->count() > 0) {

      if (Posts::where('video', '=', $post->first()->video)->count() <= 1) {
        Storage::disk('content')->delete('video/' . $post->first()->video);
      }

      $post->delete();

      return response()->json(['result' => true]);
    }

    return response()->json(['result' => false]);
  }

  public function showVideo(Request $request)
  {
    $video = strval($request->route('video'));

    $video = StorageHelper::videos()->posts()->video($video);

    if (is_null($video)) {
      abort(404);
    }

    return $video;
  }

  public function showVideoPreview(Request $request)
  {
    $image = strval($request->route('image'));

    $preview = StorageHelper::videos()->posts()->preview($image);

    if (is_null($preview)) {
      abort(404);
    }

    return $preview;
  }
}
