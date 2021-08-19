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
    /**
     * Role Types
     *
     */
    $roleItems = [
      [
        'name'        => 'Admin',
        'slug'        => 'admin',
        'description' => 'Unverified Role',
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
        Role::create([
          'name'        => $role['name'],
          'slug'        => $role['slug'],
          'description' => $role['description'],
          'level'       => $role['level'],
          'status'       => $role['status']
        ]);
        echo "\e[32mSeeding:\e[0m RoleTableSeeder - Role:" . $role['slug'] . "\r\n";
      }
    } //end foreach

  }
}
