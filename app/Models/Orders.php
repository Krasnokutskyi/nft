<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\OrderParameters;

class Orders extends Model
{
  use HasFactory;

  protected $fillable = [
    "token",
    "name",
    "payment_method",
    "amount",
    "type",
    "status",
    "end",
  ];

  public function parameters()
  {
    return $this->hasMany(OrderParameters::class, 'order_id', 'id');
  }

  public function getParameters()
  {
    $result = [];

    $parameters = $this->parameters()->get();

    foreach ($parameters as $parameter) {
      $result[$parameter->name] = $parameter->value;
    }

    return $result;
  }
}
