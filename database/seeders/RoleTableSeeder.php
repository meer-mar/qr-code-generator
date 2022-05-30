<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\Permission;
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
    $permissions = Permission::all();

    /**
     * Role Types
     *
     */
    $roleItems = [
      [
        'name'        => 'Admin',
        'slug'        => 'admin',
        'description' => 'Super Admin role',
        'level'       => 2,
        'status'      => 1,
      ],
      [
        'name'        => 'User',
        'slug'        => 'user',
        'description' => 'User Role',
        'level'       => 1,
        'status'      => 1,
      ],
      [
        'name'        => 'Unverified',
        'slug'        => 'unverified',
        'description' => 'Unverified Role',
        'level'       => 0,
        'status'      => 1,
      ]
    ];

    /**
     * Add role items
     *
     */
    echo "\e[32mSeeding:\e[0m RoleTableSeeder\r\n";
    foreach ($roleItems as $role) {
      // check if record exist then not insert intro db
      $newRoleItem = Role::where('slug', '=', $role['slug'])->first();
      if (!$newRoleItem) {
        $newRole = Role::create([
          'name'        => $role['name'],
          'slug'        => $role['slug'],
          'description' => $role['description'],
          'level'       => $role['level'],
          'status'       => $role['status']
        ]);

        // Attach permission to admin role
        if ($role['slug'] == 'admin') {
          foreach ($permissions as $permission) {
            $permission_check = explode('.', $permission->slug);

            if ($permission_check[0] == 'user') {
              continue;
            }
            $newRole->attachPermission($permission);
          }
        }

        // Attach permission to user role
        if ($role['slug'] == 'user') {
          foreach ($permissions as $permission) {
            $permission_check = explode('.', $permission->slug);

            if ($permission_check[0] != 'user') {
              continue;
            }
            $newRole->attachPermission($permission);
          }
        }

        echo "\e[32mSeeding:\e[0m RoleTableSeeder - Role:" . $role['slug'] . "\r\n";
      }
    } //end foreach

  }
}
