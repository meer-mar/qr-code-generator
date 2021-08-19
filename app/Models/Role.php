<?php

namespace App\Models;

use App\Models\User;
use App\Traits\RoleHasRelations;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Role extends Model
{
  use HasFactory, RoleHasRelations;

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'name',
    'slug',
    'level',
    'permissions',
    'status',
  ];

  /**
   * Save roles
   *
   * @param $data
   */
  public function createRole($data = array())
  {
    return Role::create($data);
  }

  /**
   * Get all roles
   *
   */
  public function getAllRoles()
  {
    return Role::all();
  }

  // /**
  //  * Get all users for the specific roles
  //  *
  //  */
  // public function users()
  // {
  //   return $this->hasMany(User::class);
  // }
}
