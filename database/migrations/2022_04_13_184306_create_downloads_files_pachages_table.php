<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDownloadsFilesPachagesTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('downloads_files_pachages', function (Blueprint $table) {
      $table->id();
      $table->unsignedBigInteger('file_id');
      $table->unsignedBigInteger('package_id');
      $table->timestamps();

      $table->foreign('file_id')->references('id')->on('downloads_files')->cascadeOnUpdate()->cascadeOnDelete();
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
    Schema::dropIfExists('downloads_files_pachages');
  }
}
