<?php

namespace App\Helpers\Storage\Content\Blog;

use App\Models\BlogPosts as Posts;
use Illuminate\Support\Facades\Storage;
use Response;

class StorageBlogPostsHelper
{
  public function preview(string $image)
  {
    $posts = Posts::where('preview', '=', $image);

    if ($posts->count() > 0) {

      $post = $posts->first();

      $preview_path = 'blog/preview/' . $post->preview;

      if (Storage::disk('content')->exists($preview_path)) {

        $preview = Storage::disk('content')->get($preview_path);
        $response = Response::make($preview);
        $response->headers->set("Content-Type", Storage::disk('content')->mimeType($preview_path));
        return $response;
      }
    }

    return null;
  }

  public function getInfoAboutPreview($post_id)
  {
    $result = [];

    $post = Posts::where('id', '=', $post_id)->get();

    if ($post->count() === 1) {

      $post = $post->first();

      $preview_path = 'blog/preview/' . $post->preview;

      if (Storage::disk('content')->exists($preview_path)) {

        $file = route('admin.storage.content.blog.preview', ['image' =>$post->preview]);
        $url = route('admin.storage.content.blog.preview', ['image' => $post->preview]);

        $result[] = [
          'name' => $post->first()->preview,
          'size' => Storage::disk('content')->size($preview_path),
          'type' => Storage::disk('content')->mimeType($preview_path),
          'file' => $file,
          'url' => $url,
        ];
      }
    }

    return $result;
  }
}