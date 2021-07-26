<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    // Insert role data db
    $roleItems = [
      [
        'name' => 'Admin',
        'slug' => 'admin',
        'level' => 5,
        'permissions' => 1,
        'status' => 1
      ],
      [
        'name' => 'User',
        'slug' => 'user',
        'level' => 1,
        'permissions' => 2,
        'status' => 1
      ]
    ];

    foreach ($roleItems as $role) {
      // check if record exist then not insert intro db
      $newRoleItem = Role::where('slug', '=', $role['slug'])->first();
      if (!$newRoleItem) {
        Role::create([
          'name' => $role['name'],
          'slug' => $role['slug'],
          'level' => $role['level'],
          'permissions' => $role['permissions'],
          'status' => $role['status']
        ]);
      }
    } //end foreach

  }
}
