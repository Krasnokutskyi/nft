<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDownloadsFilesTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('downloads_files', function (Blueprint $table) {
      $table->id();
      $table->unsignedBigInteger('type_id')->nullable();
      $table->string('title', 200);
      $table->text('preview');
      $table->text('file');
      $table->enum('access', ['all', 'packages', 'nobody']);
      $table->timestamps();

      $table->foreign('type_id')->references('id')->on('downloads_file_types')->cascadeOnUpdate()->nullOnDelete();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('downloads_files');
  }
}
