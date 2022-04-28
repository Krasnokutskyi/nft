<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use App\Models\VideoCategories;
use App\Models\VideoCategoriesPosts;
use App\Models\Packages;
use App\Models\VideoPostsPackages;

class VideoPosts extends Model
{
  use HasFactory;

  protected $fillable = [
    "title",
    "preview",
    "video",
    "access",
  ];

  public function categories()
  {
   return $this->hasManyThrough(VideoCategories::class, VideoCategoriesPosts::class, 'post_id', 'id', 'id', 'category_id');
  }

  public function packages()
  {
    return $this->hasManyThrough(Packages::class, VideoPostsPackages::class, 'post_id', 'id', 'id', 'package_id');
  }

  public static function getVideoByPostId($post_id)
  {
    $result = [];

    $post = self::where('id', '=', $post_id)->get();

    if ($post->count() === 1) {

      $post = $post->first();
      $video_path = 'video/' . $post->video;

      if (Storage::disk('content')->exists($video_path)) {
        $result[] = [
          'name' => $post->video,
          'size' => Storage::disk('content')->size($video_path),
          'type' => Storage::disk('content')->mimeType($video_path),
          'file' => route('storage.content.video', ['video' => $post->video]),
        ];
      }
    }

    return $result;
  }

  public static function getPreviewVideoById($post_id)
  {
    $result = [];

    $post = self::where('id', '=', $post_id)->get();

    if ($post->count() === 1) {

      $preview_path = 'video/preview/' . $post->first()->preview;

      if (Storage::disk('content')->exists($preview_path)) {

        $result[] = [
          'name' => $post->first()->preview,
          'size' => Storage::disk('content')->size($preview_path),
          'type' => Storage::disk('content')->mimeType($preview_path),
          'file' => route('storage.content.video.preview', ['image' => $post->first()->preview]),
          'url' => route('storage.content.video.preview', ['image' => $post->first()->preview]),
        ];
      }
    }

    return $result;
  }
}
