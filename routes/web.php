<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/register', function () {
    return view('register');
});

Route::get('/login', function () {
    return view('login');
});

Route::get('/logout',[AuthController::class, 'logout'])->name('logout');

Route::get('/admin/',[AuthController::class, 'adminLoginView'])->name('admin.login');
Route::get('/admin/processLogin',[AuthController::class, 'adminLogin'])->name('admin.processLogin');

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware'=>'admin'], function () {
    Route::get('/main', [adminController::class, 'main'])->name('main');
    Route::get('/rekapPendaftar', [adminController::class, 'rekapPendaftar'])->name('rekapPendaftar');
    Route::get('/rekapTeam', [adminController::class, 'rekapTeam'])->name('rekapTeam');
});

