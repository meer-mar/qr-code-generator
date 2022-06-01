<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Admin\WebSettingController;
use App\Http\Controllers\Admin\AccessController;
use App\Http\Controllers\Admin\AppSettingController;
use App\Http\Controllers\Admin\BlogArticleController;
use App\Http\Controllers\Admin\BlogCategoryController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/// Public routes
Route::controller(SiteController::class)->group(function () {
  // Main page
  Route::get('/', 'index')
    ->name('home');
});

/// Protected routes
Route::middleware(['auth'])->group(function () {
  // User dashboard
  Route::get('/dashboard', [DashboardController::class, 'index'])
    ->name('dashboard')
    ->middleware('checkpermission:dashboard');
});

require __DIR__ . '/auth.php';

/*
|--------------------------------------------------------------------------
| Admin dashboard Routes
|--------------------------------------------------------------------------
*/

Route::prefix('/admin')->group(function () {
  Route::middleware(['checkrole:admin'])->group(function () {
    // Dashboard
    Route::get('/', [DashboardController::class, 'index'])
      ->name('admin.dashboard')
      ->middleware('checkpermission:admin.dashboard.view');

    // Users
    Route::controller(UsersController::class)->group(function () {
      Route::get('/users', 'index')
        ->name('view.users')
        ->middleware('checkpermission:view.users');

      Route::get('/user/add', 'create')
        ->name('create.users')
        ->middleware('checkpermission:create.users');

      Route::post('/user/save', 'store')
        ->name('save.users')
        ->middleware('checkpermission:create.users');

      Route::get('/user/delete/{id}', 'destroy')
        ->name('delete.users')
        ->middleware('checkpermission:delete.users');

      Route::get('/user/edit/{id}', 'edit')
        ->name('edit.users')
        ->middleware('checkpermission:update.users');

      Route::put('/user/{id}', 'update')
        ->name('update.users')
        ->middleware('checkpermission:update.users');
    });

    // Roles & permissions
    Route::get('/roles-permissions', [AccessController::class, 'index'])
      ->name('view.roles-permissions')
      ->middleware('checkpermission:view.roles.permissions');

    Route::controller(RoleController::class)->group(function () {
      Route::prefix('/role')->name('role')->group(function () {
        Route::get('/add', 'create')
          ->name('.create')
          ->middleware('checkpermission:create.roles');

        Route::post('/store', 'store')
          ->name('.save')
          ->middleware('checkpermission:create.roles');

        Route::get('/edit/{id}', 'edit')
          ->name('.edit')
          ->middleware('checkpermission:update.roles');

        Route::put('/{id}', 'update')
          ->name('.update')
          ->middleware('checkpermission:update.roles');

        Route::get('/delete/{id}', 'destroy')
          ->name('.delete')
          ->middleware('checkpermission:delete.roles');
      });
    });

    // Site pages
    Route::controller(PageController::class)->group(function () {
      Route::get('/pages', 'index')
        ->name('view.pages')
        ->middleware('checkpermission:view.pages');

      Route::get('/page/add', 'create')
        ->name('create.pages')
        ->middleware('checkpermission:create.pages');

      Route::post('/page/save', 'store')
        ->name('save.pages')
        ->middleware('checkpermission:create.pages');

      Route::get('/page/delete/{id}', 'destroy')
        ->name('delete.pages')
        ->middleware('checkpermission:delete.pages');

      Route::get('/page/edit/{id}', 'edit')
        ->name('edit.pages')
        ->middleware('checkpermission:update.pages');

      Route::put('/page/{id}', 'update')
        ->name('update.pages')
        ->middleware('checkpermission:update.pages');
    });

    // Blog Category
    Route::controller(BlogCategoryController::class)->group(function () {
      Route::get('/blog/category', 'index')
        ->name('blog.category.view')
        ->middleware('checkpermission:view.blog.category');

      Route::get('/blog/category/add', 'create')
        ->name('blog.category.create')
        ->middleware('checkpermission:create.blog.category');

      Route::post('/blog/category/add', 'store')
        ->middleware('checkpermission:create.blog.category');

      Route::get('/blog/category/delete/{id}', 'destroy')
        ->name('blog.category.delete')
        ->middleware('checkpermission:delte.blog.category');

      Route::get('/blog/category/edit/{id}', 'edit')
        ->name('blog.category.update')
        ->middleware('checkpermission:update.blog.category');

      Route::put('/blog/category/edit/{id}', 'update')
        ->middleware('checkpermission:update.blog.category');
    });

    // Blog Article
    Route::controller(BlogArticleController::class)->group(function () {
      Route::get('/blog/article/{id}', 'index')
        ->name('blog.article.view')
        ->middleware('checkpermission:view.blog.article');

      Route::get('/blog/article/add/{id}', 'create')
        ->name('blog.article.create')
        ->middleware('checkpermission:create.blog.article');

      Route::post('/blog/article/add/{id}', 'store');

      Route::get('/blog/article/delete/{id}', 'destroy')
        ->name('blog.article.delete')
        ->middleware('checkpermission:delete.blog.article');

      Route::get('/blog/article/edit/{id}', 'edit')
        ->name('blog.article.update')
        ->middleware('checkpermission:update.blog.article');

      Route::put('/blog/article/edit/{id}', 'update');
    });

    // App setttings
    Route::controller(AppSettingController::class)->group(function () {
      Route::get('/app-setting/edit/{id}', 'edit')
        ->name('edit.app-setting')
        ->middleware('checkpermission:update.app.settings');

      Route::put('/app-setting/{id}', 'update')
        ->name('update.app-setting')
        ->middleware('checkpermission:update.app.settings');
    });

    // Web settings
    Route::controller(WebSettingController::class)->group(function () {
      Route::get('/web-setting/edit/{id}', 'edit')
        ->name('edit.web-setting')
        ->middleware('checkpermission:update.web.settings');

      Route::put('/web-setting/{id}', 'update')
        ->name('update.web-setting')
        ->middleware('checkpermission:update.web.settings');
    });
  });
});
