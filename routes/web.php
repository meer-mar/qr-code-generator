<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\UsersController;

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

Route::get('/', function () {
    return view('welcome');
});


/*
|--------------------------------------------------------------------------
| Admin dashboard Routes
|--------------------------------------------------------------------------
*/

Route::prefix('/admin')->group(function () {
    Route::get('/', [DashboardController::class, 'index']);

    Route::get('/users', [UsersController::class, 'index']);
    Route::get('/user/add', [UsersController::class, 'create']);
    Route::post('/user/save', [UsersController::class, 'store']);
    Route::get('/user/delete/{id}', [UsersController::class, 'destroy']);
    Route::get('/user/edit/{id}', [UsersController::class, 'edit']);
    Route::put('/user/{id}', [UsersController::class, 'update']);
});
