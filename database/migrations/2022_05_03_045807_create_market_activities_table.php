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
    Schema::create('market_activities', function (Blueprint $table) {
      $table->id();
      $table->integer('position');
      $table->text('preview');
      $table->text('icon_coin');
      $table->string('name', 535);
      $table->text('volume');
      $table->text('floor_price');
      $table->text('shift');
      $table->enum('status', ['active', 'deactivated'])->default('deactivated');
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
    Schema::dropIfExists('market_activities');
  }
};
