<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('calendars', function (Blueprint $table) {
      $table->id();
      $table->string('title', 535);
      $table->timestamp('start');
      $table->timestamp('end');
      $table->enum('category', ['allday', 'time']);
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
    Schema::dropIfExists('calendars');
  }
};
