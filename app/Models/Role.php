<?php

namespace App\Models;

use App\Models\User;
use App\Traits\RoleHasRelations;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Role extends Model
{
  use HasFactory, SoftDeletes, RoleHasRelations;

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'name',
    'slug',
    'level',
    'description',
    'status',
  ];

  /**
   * Get all users for the specific roles
   *
   */
  public function users()
  {
    return $this->hasMany(User::class);
  }
}
