<?php

namespace Database\Seeders;

use App\Models\User;
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
    // Insert admin record for admin login
    User::create([
      'name' => 'Bilal Shah',
      'email' => 'admin@admin.com',
      'role_id' => 1,
      'password' => Hash::make('admin'),
      'profile_photo' => 'default.png',
      'status' => 1
    ]);
  }
}
