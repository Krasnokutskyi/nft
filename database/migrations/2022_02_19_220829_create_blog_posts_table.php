<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlogPostsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('blog_posts', function (Blueprint $table) {
      $table->id();
      $table->text('preview');
      $table->string('title', 200);
      $table->char('alias', 255)->unique();
      $table->longText('text');
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
    Schema::dropIfExists('blog_posts');
  }
}
