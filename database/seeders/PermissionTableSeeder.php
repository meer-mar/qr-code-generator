<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    /**
     * Permission items
     *
     */
    $permissionItems = [
      [
        'name'        => 'Can View Admin Dashboard',
        'slug'        => 'admin',
        'description' => 'Can view admin dashboard',
        'model'       => 'App\Models\Dashboard',
        'status'      => 1,
      ],
      [
        'name'        => 'Can View Users',
        'slug'        => 'view.users',
        'description' => 'Can view users',
        'model'       => 'App\Models\User',
        'status'      => 1,
      ],
      [
        'name'        => 'Can Create Users',
        'slug'        => 'create.users',
        'description' => 'Can create new users',
        'model'       => 'App\Models\User',
        'status'      => 1,
      ],
      [
        'name'        => 'Can Save Users',
        'slug'        => 'save.users',
        'description' => 'Can save new users',
        'model'       => 'App\Models\User',
        'status'      => 1,
      ],
      [
        'name'        => 'Can Edit Users',
        'slug'        => 'edit.users',
        'description' => 'Can edit users',
        'model'       => 'App\Models\User',
        'status'      => 1,
      ],
      [
        'name'        => 'Can Update Users',
        'slug'        => 'update.users',
        'description' => 'Can Update users',
        'model'       => 'App\Models\User',
        'status'      => 1,
      ],
      [
        'name'        => 'Can Delete Users',
        'slug'        => 'delete.users',
        'description' => 'Can delete users',
        'model'       => 'App\Models\User',
        'status'      => 1,
      ],
      [
        'name'        => 'Can View Roles & Permission',
        'slug'        => 'view.roles-permissions',
        'description' => 'Can view roles & permission',
        'model'       => 'App\Models\Role',
        'status'      => 1,
      ],
      [
        'name'        => 'Can Create Roles',
        'slug'        => 'role.create',
        'description' => 'Can create roles',
        'model'       => 'App\Models\Role',
        'status'      => 1,
      ],
      [
        'name'        => 'Can Save Roles',
        'slug'        => 'role.save',
        'description' => 'Can save roles',
        'model'       => 'App\Models\Role',
        'status'      => 1,
      ],
      [
        'name'        => 'Can Edit Roles',
        'slug'        => 'role.edit',
        'description' => 'Can edit roles',
        'model'       => 'App\Models\Role',
        'status'      => 1,
      ],
      [
        'name'        => 'Can Update Roles',
        'slug'        => 'role.update',
        'description' => 'Can update roles',
        'model'       => 'App\Models\Role',
        'status'      => 1,
      ],
      [
        'name'        => 'Can Delete Roles',
        'slug'        => 'role.delete',
        'description' => 'Can delete roles',
        'model'       => 'App\Models\Role',
        'status'      => 1,
      ],
      [
        'name'        => 'Can View Pages',
        'slug'        => 'view.pages',
        'description' => 'Can view pages',
        'model'       => 'App\Models\Page',
        'status'      => 1,
      ],
      [
        'name'        => 'Can Create Pages',
        'slug'        => 'create.pages',
        'description' => 'Can create new pages',
        'model'       => 'App\Models\Page',
        'status'      => 1,
      ],
      [
        'name'        => 'Can Save Pages',
        'slug'        => 'save.pages',
        'description' => 'Can save new pages',
        'model'       => 'App\Models\Page',
        'status'      => 1,
      ],
      [
        'name'        => 'Can Edit Pages',
        'slug'        => 'edit.pages',
        'description' => 'Can edit pages',
        'model'       => 'App\Models\Page',
        'status'      => 1,
      ],
      [
        'name'        => 'Can Update Pages',
        'slug'        => 'update.pages',
        'description' => 'Can Update pages',
        'model'       => 'App\Models\Page',
        'status'      => 1,
      ],
      [
        'name'        => 'Can Delete Pages',
        'slug'        => 'delete.pages',
        'description' => 'Can delete pages',
        'model'       => 'App\Models\Page',
        'status'      => 1,
      ],
      [
        'name'        => 'Can Edit App Settings',
        'slug'        => 'edit.app-settings',
        'description' => 'Can edit app settings',
        'model'       => 'App\Models\AppSetting',
        'status'      => 1,
      ],
      [
        'name'        => 'Can Update App Settings',
        'slug'        => 'update.app-settings',
        'description' => 'Can update app settings',
        'model'       => 'App\Models\AppSetting',
        'status'      => 1,
      ],
      [
        'name'        => 'Can Edit Web Settings',
        'slug'        => 'edit.web-settings',
        'description' => 'Can edit web settings',
        'model'       => 'App\Models\WebSetting',
        'status'      => 1,
      ],
      [
        'name'        => 'Can Update Web Settings',
        'slug'        => 'update.web-settings',
        'description' => 'Can update web settings',
        'model'       => 'App\Models\WebSetting',
        'status'      => 1,
      ],
      [
        'name'        => 'Can View User Dashboard',
        'slug'        => 'dashboard',
        'description' => 'Can view user dashboard',
        'model'       => 'App\Models\Dashboard',
        'status'      => 1,
      ],
    ];

    /**
     * Add permission items
     *
     */
    echo "\e[32mSeeding:\e[0m PermissionitemsTableSeeder\r\n";
    foreach ($permissionItems as $permissionItem) {
      $newPermissionItem = Permission::where('slug', '=', $permissionItem['slug'])->first();
      if ($newPermissionItem === null) {
        $newPermissionItem = Permission::create([
          'name'          => $permissionItem['name'],
          'slug'          => $permissionItem['slug'],
          'description'   => $permissionItem['description'],
          'model'         => $permissionItem['model'],
        ]);
        echo "\e[32mSeeding:\e[0m PermissionitemsTableSeeder - Permission:" . $permissionItem['slug'] . "\r\n";
      }
    }
    echo "\e[32mSeeding:\e[0m Permissions - complete\r\n";
  }
}
