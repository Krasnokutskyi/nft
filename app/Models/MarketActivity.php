<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MarketActivity extends Model
{
  use HasFactory;

  /**
   * The attributes that are mass assignable.
   *
   * @var array<int, string>
   */
  protected $fillable = [
    'position',
    'icon_coin',
    'preview',
    'name',
    'volume',
    'floor_price',
    'shift',
    'status',
  ];
}
