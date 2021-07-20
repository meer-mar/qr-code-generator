<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\AccessController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AppSettingController;
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
  Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
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
  Route::middleware(['authrole'])->group(function () {
    // Dashboard
    Route::get('/', [DashboardController::class, 'index'])->name('admin');

    // Users
    Route::get('/users', [UsersController::class, 'index']);
    Route::get('/user/add', [UsersController::class, 'create']);
    Route::post('/user/save', [UsersController::class, 'store']);
    Route::get('/user/delete/{id}', [UsersController::class, 'destroy']);
    Route::get('/user/edit/{id}', [UsersController::class, 'edit']);
    Route::put('/user/{id}', [UsersController::class, 'update']);

    // Roles & permissions
    Route::get('/roles-permissions', [AccessController::class, 'index']);
    Route::get('/role/add', [RoleController::class, 'create']);
    Route::post('/role/store', [RoleController::class, 'store']);

    // App setttings
    Route::get('/app-setting/edit/{id}', [AppSettingController::class, 'edit']);
    Route::put('/app-setting/{id}', [AppSettingController::class, 'update']);

    // Web settings
    Route::get('/web-setting/edit/{id}', [WebSettingController::class, 'edit']);
    Route::put('/web-setting/{id}', [WebSettingController::class, 'update']);
  });
});
