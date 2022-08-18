<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\Sub_MenuController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Access_MenuController;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [DashboardController::class, 'index'])->middleware('auth');
Route::resource('/dashboard', DashboardController::class)->middleware('auth');

Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout']);

//untuk Menu
Route::get('/konfigurasi/menu/checkSlug', [MenuController::class, 'checkSlug'])->middleware('admin');
Route::resource('/konfigurasi/menu', MenuController::class)->middleware('admin');

//untuk Sub Menu
Route::get('/konfigurasi/sub_menu/checkSlug', [Sub_MenuController::class, 'checkSlug'])->middleware('admin');
Route::get('/sub_menu_update_status_sukses', [Sub_MenuController::class, 'sub_menu_update_status_sukses'])->middleware('admin');
Route::get('/sub_menu_update_status_aktif', [Sub_MenuController::class, 'sub_menu_update_status_aktif'])->middleware('admin');
Route::resource('/konfigurasi/sub_menu', Sub_MenuController::class)->middleware('admin');

//untuk access menu harus diatas dari role karena resource
Route::get('/konfigurasi/role/access_menu/{request:slug}', [Access_MenuController::class, 'index'])->middleware('admin');
Route::get('/konfigurasi/role/update_access_menu', [Access_MenuController::class, 'update_access_menu'])->middleware('admin');

//untuk user role
Route::get('/konfigurasi/role/checkSlug', [RoleController::class, 'checkSlug'])->middleware('admin');
Route::resource('/konfigurasi/role', RoleController::class)->middleware('admin');



//untuk user
Route::get('/konfigurasi/user/checkSlug', [UserController::class, 'checkSlug'])->middleware('admin');
Route::resource('/konfigurasi/user', UserController::class)->middleware('admin');
Route::get('/konfigurasi/user_update_status_sukses', [UserController::class, 'user_update_status_sukses'])->middleware('admin');
Route::get('/konfigurasi/user_update_status_aktif', [UserController::class, 'user_update_status_aktif'])->middleware('admin');
