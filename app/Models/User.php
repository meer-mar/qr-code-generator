<?php

namespace App\Models;

use App\Models\Role;
use App\Traits\HasRoleAndPermission;
use Illuminate\Support\Facades\Storage;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
  use HasFactory, Notifiable, HasRoleAndPermission;

  // Table Name
  protected $table = 'users';

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'name',
    'email',
    'password',
    'profile_photo',
    'role_id',
    'status',
  ];

  /**
   * The attributes that should be hidden for arrays.
   *
   * @var array
   */
  protected $hidden = [
    'password',
    'remember_token',
  ];

  /**
   * The attributes that should be cast to native types.
   *
   * @var array
   */
  protected $casts = [
    'email_verified_at' => 'datetime',
  ];

  /**
   * Save user data in db
   *
   * @param $data
   */
  public function createUser($data = array())
  {
    return User::create($data);
  }

  /**
   * Get all user data.
   *
   */
  public function getAllUsers()
  {
    return User::all();
  }

  /**
   * Get single user data
   *
   * @param int $id
   */
  public function getUser($id)
  {
    return User::find($id);
  }

  /**
   * Delete user data
   *
   * @param int $id
   */
  public function deleteUser($id)
  {
    // delete user profile image
    $user = User::find($id);
    if ($user->profile_photo != 'no_img.jpg') {
      Storage::delete('public/user_profile_photos/' . $user->profile_photo);
    }

    return User::destroy($id);
  }

  /**
   * update user data
   *
   * @param array $data
   * @param int $id
   */
  public function updateUser($data = array(), $id)
  {
    $user = $this->getUser($id);
    return $user->update($data);
  }

  /**
   * User Relation to role
   *
   */
  public function role()
  {
    return $this->belongsTo(Role::class);
  }
}
