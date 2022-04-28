<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVideoPostsPackagesTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('video_posts_packages', function (Blueprint $table) {
      $table->id();
      $table->unsignedBigInteger('post_id');
      $table->unsignedBigInteger('package_id');
      $table->timestamps();

      $table->foreign('post_id')->references('id')->on('video_posts')->cascadeOnUpdate()->cascadeOnDelete();
      $table->foreign('package_id')->references('id')->on('packages')->cascadeOnUpdate()->cascadeOnDelete();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('video_posts_packages');
  }
}
