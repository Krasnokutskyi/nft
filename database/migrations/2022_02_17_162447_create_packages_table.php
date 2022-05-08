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
      $table->string('name', 100)->unique();
      $table->set('content', ['videos', 'blog', 'downloads', 'calendar', 'market activity']);
      $table->enum('redirect_content', ['videos', 'blog', 'downloads', 'calendar', 'market activity']);
      $table->decimal('price', 19, 2);
      $table->decimal('discount', 19, 2);
      $table->string('subtitle', 100)->nullable();
      $table->text('сontent_list')->nullable();
      $table->text('extra_сontent_list')->nullable();
      $table->text('preview');
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
