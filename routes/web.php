<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\AccessController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AppSettingController;
use App\Http\Controllers\WebSettingController;
use App\Http\Controllers\BlogArticleController;
use App\Http\Controllers\BlogCategoryController;

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

Route::get('/', [PagesController::class, 'index']);

Route::middleware(['auth'])->group(function () {
  Route::get('/dashboard', [DashboardController::class, 'index'])
    ->name('dashboard')
    ->middleware('checkpermission:dashboard');
});
// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth'])->name('dashboard');

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
    Route::get('/users', [UsersController::class, 'index'])
      ->name('view.users')
      ->middleware('checkpermission:view.users');

    Route::get('/user/add', [UsersController::class, 'create'])
      ->name('create.users')
      ->middleware('checkpermission:create.users');

    Route::post('/user/save', [UsersController::class, 'store'])
      ->name('save.users')
      ->middleware('checkpermission:create.users');

    Route::get('/user/delete/{id}', [UsersController::class, 'destroy'])
      ->name('delete.users')
      ->middleware('checkpermission:delete.users');

    Route::get('/user/edit/{id}', [UsersController::class, 'edit'])
      ->name('edit.users')
      ->middleware('checkpermission:update.users');

    Route::put('/user/{id}', [UsersController::class, 'update'])
      ->name('update.users')
      ->middleware('checkpermission:update.users');

    // Roles & permissions
    Route::get('/roles-permissions', [AccessController::class, 'index'])
      ->name('view.roles-permissions')
      ->middleware('checkpermission:view.roles.permissions');

    Route::prefix('/role')->name('role')->group(function () {
      Route::get('/add', [RoleController::class, 'create'])
        ->name('.create')
        ->middleware('checkpermission:create.roles');

      Route::post('/store', [RoleController::class, 'store'])
        ->name('.save')
        ->middleware('checkpermission:create.roles');

      Route::get('/edit/{id}', [RoleController::class, 'edit'])
        ->name('.edit')
        ->middleware('checkpermission:update.roles');

      Route::put('/{id}', [RoleController::class, 'update'])
        ->name('.update')
        ->middleware('checkpermission:update.roles');

      Route::get('/delete/{id}', [RoleController::class, 'destroy'])
        ->name('.delete')
        ->middleware('checkpermission:delete.roles');
    });

    // Site pages
    Route::get('/pages', [PageController::class, 'index'])
      ->name('view.pages')
      ->middleware('checkpermission:view.pages');

    Route::get('/page/add', [PageController::class, 'create'])
      ->name('create.pages')
      ->middleware('checkpermission:create.pages');

    Route::post('/page/save', [PageController::class, 'store'])
      ->name('save.pages')
      ->middleware('checkpermission:create.pages');

    Route::get('/page/delete/{id}', [PageController::class, 'destroy'])
      ->name('delete.pages')
      ->middleware('checkpermission:delete.pages');

    Route::get('/page/edit/{id}', [PageController::class, 'edit'])
      ->name('edit.pages')
      ->middleware('checkpermission:update.pages');

    Route::put('/page/{id}', [PageController::class, 'update'])
      ->name('update.pages')
      ->middleware('checkpermission:update.pages');

    // Blog Category
    Route::get('/blog/category', [BlogCategoryController::class, 'index'])
      ->name('blog.category.view')
      ->middleware('checkpermission:view.blog.category');

    Route::get('/blog/category/add', [BlogCategoryController::class, 'create'])
      ->name('blog.category.create')
      ->middleware('checkpermission:create.blog.category');

    Route::post('/blog/category/add', [BlogCategoryController::class, 'store'])
      ->middleware('checkpermission:create.blog.category');

    Route::get('/blog/category/delete/{id}', [BlogCategoryController::class, 'destroy'])
      ->name('blog.category.delete')
      ->middleware('checkpermission:delte.blog.category');

    Route::get('/blog/category/edit/{id}', [BlogCategoryController::class, 'edit'])
      ->name('blog.category.update')
      ->middleware('checkpermission:update.blog.category');

    Route::put('/blog/category/edit/{id}', [BlogCategoryController::class, 'update'])
      ->middleware('checkpermission:update.blog.category');

    // Blog Article
    Route::get('/blog/article/{id}', [BlogArticleController::class, 'index'])
      ->name('blog.article.view')
      ->middleware('checkpermission:view.blog.article');

    Route::get('/blog/article/add/{id}', [BlogArticleController::class, 'create'])
      ->name('blog.article.create')
      ->middleware('checkpermission:create.blog.article');

    Route::post('/blog/article/add/{id}', [BlogArticleController::class, 'store']);

    Route::get('/blog/article/delete/{id}', [BlogArticleController::class, 'destroy'])
      ->name('blog.article.delete')
      ->middleware('checkpermission:delete.blog.article');

    Route::get('/blog/article/edit/{id}', [BlogArticleController::class, 'edit'])
      ->name('blog.article.update')
      ->middleware('checkpermission:update.blog.article');

    Route::put('/blog/article/edit/{id}', [BlogArticleController::class, 'update']);

    // App setttings
    Route::get('/app-setting/edit/{id}', [AppSettingController::class, 'edit'])
      ->name('edit.app-setting')
      ->middleware('checkpermission:update.app.settings');

    Route::put('/app-setting/{id}', [AppSettingController::class, 'update'])
      ->name('update.app-setting')
      ->middleware('checkpermission:update.app.settings');


    // Web settings
    Route::get('/web-setting/edit/{id}', [WebSettingController::class, 'edit'])
      ->name('edit.web-setting')
      ->middleware('checkpermission:update.web.settings');

    Route::put('/web-setting/{id}', [WebSettingController::class, 'update'])
      ->name('update.web-setting')
      ->middleware('checkpermission:update.web.settings');
  });
});
