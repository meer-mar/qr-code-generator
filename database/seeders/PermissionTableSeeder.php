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
        'name'        => 'Can View Dashboard',
        'slug'        => 'admin',
        'description' => 'Can view admin dashboard',
        'model'       => 'App\Dashboard',
      ],
      [
        'name'        => 'Can View Users',
        'slug'        => 'view.users',
        'description' => 'Can view users',
        'model'       => 'App\User',
      ],
      [
        'name'        => 'Can Create Users',
        'slug'        => 'create.users',
        'description' => 'Can create new users',
        'model'       => 'App\User',
      ],
      [
        'name'        => 'Can Save Users',
        'slug'        => 'save.users',
        'description' => 'Can save new users',
        'model'       => 'App\User',
      ],
      [
        'name'        => 'Can Edit Users',
        'slug'        => 'edit.users',
        'description' => 'Can edit users',
        'model'       => 'App\User',
      ],
      [
        'name'        => 'Can Update Users',
        'slug'        => 'update.users',
        'description' => 'Can Update users',
        'model'       => 'App\User',
      ],
      [
        'name'        => 'Can Delete Users',
        'slug'        => 'delete.users',
        'description' => 'Can delete users',
        'model'       => 'App\User',
      ],
      [
        'name'        => 'Can View Roles & Permission',
        'slug'        => 'view.roles-permissions',
        'description' => 'Can view roles & permission',
        'model'       => 'App\Role',
      ],
      [
        'name'        => 'Can Create Roles',
        'slug'        => 'create.roles',
        'description' => 'Can create roles',
        'model'       => 'App\Role',
      ],
      [
        'name'        => 'Can Save Roles',
        'slug'        => 'save.roles',
        'description' => 'Can save roles',
        'model'       => 'App\Role',
      ],
      [
        'name'        => 'Can View Pages',
        'slug'        => 'view.pages',
        'description' => 'Can view pages',
        'model'       => 'App\Page',
      ],
      [
        'name'        => 'Can Create Pages',
        'slug'        => 'create.pages',
        'description' => 'Can create new pages',
        'model'       => 'App\Page',
      ],
      [
        'name'        => 'Can Save Pages',
        'slug'        => 'save.pages',
        'description' => 'Can save new pages',
        'model'       => 'App\Page',
      ],
      [
        'name'        => 'Can Edit Pages',
        'slug'        => 'edit.pages',
        'description' => 'Can edit pages',
        'model'       => 'App\Page',
      ],
      [
        'name'        => 'Can Update Pages',
        'slug'        => 'update.pages',
        'description' => 'Can Update pages',
        'model'       => 'App\Page',
      ],
      [
        'name'        => 'Can Delete Pages',
        'slug'        => 'delete.pages',
        'description' => 'Can delete pages',
        'model'       => 'App\Page',
      ],
      [
        'name'        => 'Can Edit App Settings',
        'slug'        => 'edit.app-settings',
        'description' => 'Can edit app settings',
        'model'       => 'App\AppSetting',
      ],
      [
        'name'        => 'Can Update App Settings',
        'slug'        => 'update.app-settings',
        'description' => 'Can update app settings',
        'model'       => 'App\AppSetting',
      ],
      [
        'name'        => 'Can Edit Web Settings',
        'slug'        => 'edit.web-settings',
        'description' => 'Can edit web settings',
        'model'       => 'App\WebSetting',
      ],
      [
        'name'        => 'Can Update Web Settings',
        'slug'        => 'update.web-settings',
        'description' => 'Can update web settings',
        'model'       => 'App\WebSetting',
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
