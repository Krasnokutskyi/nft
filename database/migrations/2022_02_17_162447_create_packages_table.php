<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePackagesTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('packages', function (Blueprint $table) {
      $table->id();
      $table->integer('position');
      $table->string('name')->unique();
      $table->set('content', ['videos', 'blog', 'downloads', 'calendar', 'market activity']);
      $table->set('redirect_content', ['videos', 'blog', 'downloads', 'calendar', 'market activity']);
      $table->decimal('price', 19, 2);
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
      Schema::dropIfExists('packages');
  }
}
