<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
  use HasFactory;

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
}
