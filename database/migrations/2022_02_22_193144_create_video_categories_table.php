<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVideoCategoriesTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('video_categories', function (Blueprint $table) {
      $table->id();
      $table->string('title', 100);
      $table->char('alias', 255)->unique();
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
    Schema::dropIfExists('video_categories');
  }
}
