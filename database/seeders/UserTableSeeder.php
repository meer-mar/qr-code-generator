<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use App\Models\Permission;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    $adminRole = Role::where('slug', '=', 'admin')->first();
    $userRole = Role::where('slug', '=', 'user')->first();

    $permissions = Permission::all();

    /**
     * Insert admin details for login
     *
     */
    echo "\e[32mSeeding:\e[0m UserTableSeeder\r\n";

    if (User::where('email', '=', 'admin@admin.com')->first() === null) {
      $newUser = User::create([
        'name'              => 'Super Admin',
        'email'             => 'admin@admin.com',
        'email_verified_at' => now(),
        'password'          => Hash::make('admin'),
        'profile_photo'     => 'default.png',
        'status'            => 1
      ]);

      $newUser->attachRole($adminRole);

      echo "\e[32mSeeding:\e[0m UsersTableSeeder - user:admin@admin.com\r\n";
    }

    if (User::where('email', '=', 'johnconnor2996@gmail.com')->first() === null) {
      $newUser = User::create([
        'name'              => 'John Connor',
        'email'             => 'johnconnor2996@gmail.com',
        'email_verified_at' => now(),
        'password'          => Hash::make('password'),
        'profile_photo'     => 'default.png',
        'status'            => 1
      ]);

      $newUser->attachRole($userRole);

      echo "\e[32mSeeding:\e[0m UsersTableSeeder - user:johnconnor2996@gmail.com\r\n";
    }
  }
}
