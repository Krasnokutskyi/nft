<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderParametersTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('order_parameters', function (Blueprint $table) {
      $table->id();
      $table->unsignedBigInteger('order_id');
      $table->text('name');
      $table->text('value');

      $table->foreign('order_id')->references('id')->on('orders')->cascadeOnUpdate()->cascadeOnDelete();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
      Schema::dropIfExists('order_parameters');
  }
}
