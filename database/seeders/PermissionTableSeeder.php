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
        'name'        => 'Admin dashboard view',
        'slug'        => 'admin.dashboard.view',
        'description' => 'Can view admin dashboard',
        'model'       => null,
        'status'      => 1,
      ],
      [
        'name'        => 'View Users',
        'slug'        => 'view.users',
        'description' => 'Can view users',
        'model'       => 'App\Models\User',
        'status'      => 1,
      ],
      [
        'name'        => 'Create Users',
        'slug'        => 'create.users',
        'description' => 'Can create new users',
        'model'       => 'App\Models\User',
        'status'      => 1,
      ],
      [
        'name'        => 'Update Users',
        'slug'        => 'update.users',
        'description' => 'Can Update users',
        'model'       => 'App\Models\User',
        'status'      => 1,
      ],
      [
        'name'        => 'Delete Users',
        'slug'        => 'delete.users',
        'description' => 'Can delete users',
        'model'       => 'App\Models\User',
        'status'      => 1,
      ],
      [
        'name'        => 'Roles Permission',
        'slug'        => 'view.roles.permissions',
        'description' => 'Can view roles & permission',
        'model'       => 'App\Models\Role',
        'status'      => 1,
      ],
      [
        'name'        => 'Create Roles',
        'slug'        => 'create.roles',
        'description' => 'Can create roles',
        'model'       => 'App\Models\Role',
        'status'      => 1,
      ],
      [
        'name'        => 'Update Roles',
        'slug'        => 'update.roles',
        'description' => 'Can update roles',
        'model'       => 'App\Models\Role',
        'status'      => 1,
      ],
      [
        'name'        => 'Delete Roles',
        'slug'        => 'delete.roles',
        'description' => 'Can delete roles',
        'model'       => 'App\Models\Role',
        'status'      => 1,
      ],
      [
        'name'        => 'View Pages',
        'slug'        => 'view.pages',
        'description' => 'Can view pages',
        'model'       => 'App\Models\Page',
        'status'      => 1,
      ],
      [
        'name'        => 'Create Pages',
        'slug'        => 'create.pages',
        'description' => 'Can create new pages',
        'model'       => 'App\Models\Page',
        'status'      => 1,
      ],
      [
        'name'        => 'Update Pages',
        'slug'        => 'update.pages',
        'description' => 'Can Update pages',
        'model'       => 'App\Models\Page',
        'status'      => 1,
      ],
      [
        'name'        => 'Delete Pages',
        'slug'        => 'delete.pages',
        'description' => 'Can delete pages',
        'model'       => 'App\Models\Page',
        'status'      => 1,
      ],
      [
        'name'        => 'View Blog Category',
        'slug'        => 'view.blog.category',
        'description' => 'Can view blog categories',
        'model'       => 'App\Models\BlogCategory',
        'status'      => 1,
      ],
      [
        'name'        => 'Create Blog Category',
        'slug'        => 'create.blog.category',
        'description' => 'Can create new blog categories',
        'model'       => 'App\Models\BlogCategory',
        'status'      => 1,
      ],
      [
        'name'        => 'Update Blog Category',
        'slug'        => 'update.blog.category',
        'description' => 'Can update blog categories',
        'model'       => 'App\Models\BlogCategory',
        'status'      => 1,
      ],
      [
        'name'        => 'Delete Blog Category',
        'slug'        => 'delete.blog.category',
        'description' => 'Can delete blog categories',
        'model'       => 'App\Models\BlogCategory',
        'status'      => 1,
      ],
      [
        'name'        => 'View Blog Article',
        'slug'        => 'view.blog.article',
        'description' => 'Can view blog articles',
        'model'       => 'App\Models\BlogArticle',
        'status'      => 1,
      ],
      [
        'name'        => 'Create Blog Article',
        'slug'        => 'create.blog.article',
        'description' => 'Can create new blog articles',
        'model'       => 'App\Models\BlogArticle',
        'status'      => 1,
      ],
      [
        'name'        => 'Update Blog Article',
        'slug'        => 'blog.article.update',
        'description' => 'Can update blog articles',
        'model'       => 'App\Models\BlogArticle',
        'status'      => 1,
      ],
      [
        'name'        => 'Delete Blog Article',
        'slug'        => 'delete.blog.article',
        'description' => 'Can delete blog articles',
        'model'       => 'App\Models\BlogArticle',
        'status'      => 1,
      ],
      [
        'name'        => 'Update App Settings',
        'slug'        => 'update.app.settings',
        'description' => 'Can update app settings',
        'model'       => 'App\Models\AppSetting',
        'status'      => 1,
      ],
      [
        'name'        => 'Update Web Settings',
        'slug'        => 'update.web.settings',
        'description' => 'Can update web settings',
        'model'       => 'App\Models\WebSetting',
        'status'      => 1,
      ],
      [
        'name'        => 'User Dashboard View',
        'slug'        => 'user.dashboard.view',
        'description' => 'Can view user dashboard',
        'model'       => null,
        'status'      => 1,
      ],
      [
        'name'        => 'View Faqs',
        'slug'        => 'view.faqs',
        'description' => 'Can View All Faqs',
        'model'       => 'App\Models\Faqs',
        'status'      => 1,
      ],
      [
        'name'        => 'Create Faqs',
        'slug'        => 'create.faqs',
        'description' => 'Can Create Faqs',
        'model'       => 'App\Models\Faqs',
        'status'      => 1,
      ],
      [
        'name'        => 'Store Faqs',
        'slug'        => 'store.faqs',
        'description' => 'Can Store All Faqs',
        'model'       => 'App\Models\Faqs',
        'status'      => 1,
      ],
      [
        'name'        => 'Edit Faqs',
        'slug'        => 'edit.faqs',
        'description' => 'Can Edit All Faqs',
        'model'       => 'App\Models\Faqs',
        'status'      => 1,
      ],
      [
        'name'        => 'Delete Faqs',
        'slug'        => 'destroy.faqs',
        'description' => 'Can Delete All Faqs',
        'model'       => 'App\Models\Faqs',
        'status'      => 1,
      ],
      [
        'name'        => 'Update Faqs',
        'slug'        => 'update.faqs',
        'description' => 'Can Updare All Faqs',
        'model'       => 'App\Models\Faqs',
        'status'      => 1,
      ],
      [
        'name'        => 'View Banner',
        'slug'        => 'view.banners',
        'description' => 'Can View All Banner',
        'model'       => 'App\Models\Banner',
        'status'      => 1,
      ],
      [
        'name'        => 'Create Banner',
        'slug'        => 'create.banners',
        'description' => 'Can Create Banner',
        'model'       => 'App\Models\Banner',
        'status'      => 1,
      ],
      [
        'name'        => 'Store Banner',
        'slug'        => 'store.banners',
        'description' => 'Can Store All Banner',
        'model'       => 'App\Models\Banner',
        'status'      => 1,
      ],
      [
        'name'        => 'Edit Banner',
        'slug'        => 'edit.banners',
        'description' => 'Can Edit All Banner',
        'model'       => 'App\Models\Banner',
        'status'      => 1,
      ],
      [
        'name'        => 'Delete Banner',
        'slug'        => 'destroy.banners',
        'description' => 'Can Delete All Banner',
        'model'       => 'App\Models\Banner',
        'status'      => 1,
      ],
      [
        'name'        => 'Update Banner',
        'slug'        => 'update.banners',
        'description' => 'Can Updare All Banner',
        'model'       => 'App\Models\Banner',
        'status'      => 1,
      ],
        //Sliders
        [
            'name'        => 'View Sliders',
            'slug'        => 'view.sliders',
            'description' => 'Can View All Sliders',
            'model'       => 'App\Models\S`lider',
            'status'      => 1,
          ],
          [
            'name'        => 'Create Sliders',
            'slug'        => 'create.sliders',
            'description' => 'Can Create Sliders',
            'model'       => 'App\Models\Slider',
            'status'      => 1,
          ],
          [
            'name'        => 'Store Sliders',
            'slug'        => 'store.sliders',
            'description' => 'Can Store All Sliders',
            'model'       => 'App\Models\Slider',
            'status'      => 1,
          ],
          [
            'name'        => 'Edit Sliders',
            'slug'        => 'edit.sliders',
            'description' => 'Can Edit All Sliders',
            'model'       => 'App\Models\Slider',
            'status'      => 1,
          ],
          [
            'name'        => 'Delete Sliders',
            'slug'        => 'destroy.sliders',
            'description' => 'Can Delete All Sliders',
            'model'       => 'App\Models\Slider',
            'status'      => 1,
          ],
          [
            'name'        => 'Update Sliders',
            'slug'        => 'update.sliders',
            'description' => 'Can Updare All Sliders',
            'model'       => 'App\Models\Slider',
            'status'      => 1,
          ],
          //Tags
            [
                'name'        => 'View tags',
                'slug'        => 'view.tags',
                'description' => 'Can View All tags',
                'model'       => 'App\Models\Tags',
                'status'      => 1,
              ],
              [
                'name'        => 'Create tags',
                'slug'        => 'create.tags',
                'description' => 'Can Create tags',
                'model'       => 'App\Models\Tags',
                'status'      => 1,
              ],
              [
                'name'        => 'Store tags',
                'slug'        => 'store.tags',
                'description' => 'Can Store All tags',
                'model'       => 'App\Models\Tags',
                'status'      => 1,
              ],
              [
                'name'        => 'Edit tags',
                'slug'        => 'edit.tags',
                'description' => 'Can Edit All tags',
                'model'       => 'App\Models\Tags',
                'status'      => 1,
              ],
              [
                'name'        => 'Delete tags',
                'slug'        => 'destroy.tags',
                'description' => 'Can Delete All tags',
                'model'       => 'App\Models\Tags',
                'status'      => 1,
              ],
              [
                'name'        => 'Update tags',
                'slug'        => 'update.tags',
                'description' => 'Can Updare All tags',
                'model'       => 'App\Models\Tags',
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
