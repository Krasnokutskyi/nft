<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderParameters extends Model
{
  use HasFactory;

  protected $fillable = [
    "order_id",
    "name",
    "value",
  ];

  public function scopeUpdateParam($query, $name, $value)
  {
    $query->where('name', '=', $name)->update(['value' => $value]);
  }

  public static function createParams($order_id, array $paramets): void
  {
    foreach ($paramets as $key => $value) {
      OrderParameters::create([
        'order_id' => $order_id,
        'name' => $key,
        'value' => $value,
      ]);
    }
  }

  public function scopeGetParametr($query, $name)
  {
    $parametr = $query->where('name', '=', $name)->get();

    if ($parametr->count() === 1) {
      return $parametr->first()->value;
    }

    return null;
  }
}
