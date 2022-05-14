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
    "discount",
    "content",
    "redirect_content",
    "subtitle",
    "сontent_list",
    "extra_сontent_list",
    "preview",
  ];

  public function users()
  {
   return $this->hasManyThrough(User::class, UserPackages::class, 'package_id', 'id', 'id', 'user_id');
  }
}
