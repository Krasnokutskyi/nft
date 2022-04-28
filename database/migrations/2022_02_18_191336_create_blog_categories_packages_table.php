<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlogCategoriesPackagesTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('blog_categories_packages', function (Blueprint $table) {
      $table->id();
      $table->unsignedBigInteger('category_id');
      $table->unsignedBigInteger('package_id');
      $table->timestamps();

      $table->foreign('category_id')->references('id')->on('blog_categories')->cascadeOnUpdate()->cascadeOnDelete();
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
    Schema::dropIfExists('blog_categories_packages');
  }
}
