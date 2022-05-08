<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('orders', function (Blueprint $table) {
      $table->id();
      $table->string('token', 200)->unique();
      $table->enum('payment_method', ['fibonatix']);
      $table->decimal('amount', 19, 2);
      $table->enum('type', ['user_registration']);
      $table->enum('status', [1, 0])->default(0);
      $table->timestamp('end');
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
    Schema::dropIfExists('orders');
  }
}
