<?php

namespace App\Helpers\Storage\Content\Videos;

use App\Models\VideoPosts as Posts;
use Illuminate\Support\Facades\Storage;
use Response;

class StorageVideosPostsHelper
{
  public function preview(string $image)
  {
    $posts = Posts::where('preview', '=', $image)->get();

    if ($posts->count() > 0) {

      $post = $posts->first();

      $preview_path = 'video/preview/' . $post->preview;

      if (Storage::disk('content')->exists($preview_path)) {

        $preview = Storage::disk('content')->get($preview_path);
        $response = Response::make($preview);
        $response->headers->set("Content-Type", Storage::disk('content')->mimeType($preview_path));
        return $response;
      }
    }

    return null;
  }

  public function video(string $video)
  {

    $posts = Posts::where('video', '=', $video)->get();

    if ($posts->count() > 0) {

      $post = $posts->first();

      $video_path = 'video/' . $post->video;

      if (Storage::disk('content')->exists($video_path)) {
        $video = Storage::disk('content')->get($video_path);
        $response = Response::make($video);
        $response->headers->set("Content-Type", Storage::disk('content')->mimeType($video_path));
        return $response;
      }
    }

    return null;
  }

  public static function getInfoAboutVideo($post_id)
  {
    $result = [];

    $post = Posts::where('id', '=', $post_id)->get();

    if ($post->count() === 1) {

      $post = $post->first();
      $video_path = 'video/' . $post->video;

      if (Storage::disk('content')->exists($video_path)) {
        $result[] = [
          'name' => $post->video,
          'size' => Storage::disk('content')->size($video_path),
          'type' => Storage::disk('content')->mimeType($video_path),
          'file' => route('admin.storage.content.video', ['video' => $post->video]),
          'url' => route('admin.storage.content.video', ['video' => $post->video]),
        ];
      }
    }

    return $result;
  }

  public static function getInfoAboutPreviewVideo($post_id)
  {
    $result = [];

    $post = Posts::where('id', '=', $post_id)->get();

    if ($post->count() === 1) {

      $preview_path = 'video/preview/' . $post->first()->preview;

      if (Storage::disk('content')->exists($preview_path)) {

        $result[] = [
          'name' => $post->first()->preview,
          'size' => Storage::disk('content')->size($preview_path),
          'type' => Storage::disk('content')->mimeType($preview_path),
          'file' => route('admin.storage.content.video.preview', ['image' => $post->first()->preview]),
          'url' => route('admin.storage.content.video.preview', ['image' => $post->first()->preview]),
        ];
      }
    }

    return $result;
  }
}