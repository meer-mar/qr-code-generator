<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\AccessController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AppSettingController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\WebSettingController;

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
      ->name('admin')
      ->middleware('checkpermission:admin');

    // Users
    Route::get('/users', [UsersController::class, 'index'])
      ->name('view.users')
      ->middleware('checkpermission:view.users');

    Route::get('/user/add', [UsersController::class, 'create'])
      ->name('create.users')
      ->middleware('checkpermission:create.users');

    Route::post('/user/save', [UsersController::class, 'store'])
      ->name('save.users')
      ->middleware('checkpermission:save.users');

    Route::get('/user/delete/{id}', [UsersController::class, 'destroy'])
      ->name('delete.users')
      ->middleware('checkpermission:delete.users');

    Route::get('/user/edit/{id}', [UsersController::class, 'edit'])
      ->name('edit.users')
      ->middleware('checkpermission:edit.users');

    Route::put('/user/{id}', [UsersController::class, 'update'])
      ->name('update.users')
      ->middleware('checkpermission:update.users');

    // Roles & permissions
    Route::get('/roles-permissions', [AccessController::class, 'index'])
      ->name('view.roles-permissions')
      ->middleware('checkpermission:view.roles-permissions');

    Route::prefix('/role')->name('role')->group(function () {
      Route::get('/add', [RoleController::class, 'create'])
        ->name('.create')
        ->middleware('checkpermission:role.create');

      Route::post('/store', [RoleController::class, 'store'])
        ->name('.save')
        ->middleware('checkpermission:role.save');

      Route::get('/edit/{id}', [RoleController::class, 'edit'])
        ->name('.edit')
        ->middleware('checkpermission:role.edit');

      Route::put('/{id}', [RoleController::class, 'update'])
        ->name('.update')
        ->middleware('checkpermission:role.update');

      Route::get('/delete/{id}', [RoleController::class, 'destroy'])
        ->name('.delete')
        ->middleware('checkpermission:role.delete');
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
      ->middleware('checkpermission:save.pages');

    Route::get('/page/delete/{id}', [PageController::class, 'destroy'])
      ->name('delete.pages')
      ->middleware('checkpermission:delete.pages');

    Route::get('/page/edit/{id}', [PageController::class, 'edit'])
      ->name('edit.pages')
      ->middleware('checkpermission:edit.pages');

    Route::put('/page/{id}', [PageController::class, 'update'])
      ->name('update.pages')
      ->middleware('checkpermission:update.pages');

    // App setttings
    Route::get('/app-setting/edit/{id}', [AppSettingController::class, 'edit'])
      ->name('edit.app-setting')
      ->middleware('checkpermission:edit.app-settings');

    Route::put('/app-setting/{id}', [AppSettingController::class, 'update'])
      ->name('update.app-setting')
      ->middleware('checkpermission:update.app-settings');


    // Web settings
    Route::get('/web-setting/edit/{id}', [WebSettingController::class, 'edit'])
      ->name('edit.web-setting')
      ->middleware('checkpermission:edit.web-settings');

    Route::put('/web-setting/{id}', [WebSettingController::class, 'update'])
      ->name('update.web-setting')
      ->middleware('checkpermission:update.web-settings');
  });
});
