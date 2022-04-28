<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVideoPostsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('video_posts', function (Blueprint $table) {
      $table->id();
      $table->string('title', 200);
      $table->text('preview');
      $table->text('video');
      $table->enum('access', ['all', 'packages', 'nobody']);
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('video_posts');
  }
}