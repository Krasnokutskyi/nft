<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\UserPackages;

class Packages extends Model
{
  use HasFactory;

  protected $fillable = [
    "position",
    "name",
    "price",
    "content",
  ];

  public function users()
  {
   return $this->hasManyThrough(User::class, UserPackages::class, 'user_id', 'id', 'id', 'package_id');
  }
}
