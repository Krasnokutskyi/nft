<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVideoCategoriesPostsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('video_categories_posts', function (Blueprint $table) {
      $table->id();
      $table->unsignedBigInteger('post_id');
      $table->unsignedBigInteger('category_id');
      $table->timestamps();

      $table->foreign('post_id')->references('id')->on('video_posts')->cascadeOnUpdate()->cascadeOnDelete();
      $table->foreign('category_id')->references('id')->on('video_categories')->cascadeOnUpdate()->cascadeOnDelete();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('video_categories_posts');
  }
}
